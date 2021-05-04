<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Weikit\Component\Card\Card;
use Weikit\Component\Form\Captcha;
use Weikit\Component\Form\Form;
use Weikit\Component\Form\Input;
use Weikit\Component\Form\Toggle;
use Weikit\Component\Form\Traits\HasForm;
use Weikit\Component\Layout\Grid;
use Weikit\Http\Controllers\Controller;
use Weikit\Http\Traits\HasRateLimiting;

class LoginController extends Controller
{
    use HasForm;
    use HasRateLimiting;

    public function page()
    {
        $form = $this->form();

        return inertia('weikit::auth/login', [
            'schema' => $this->getSchema($form),
        ]);
    }

    public function login(Request $request)
    {
        $this->rateLimit(5);

        $this->validate();

        $guard = auth();
        if ( ! $guard->attempt($request->only(['username', 'password']), $request->remember)) {
            throw ValidationException::withMessages([
                'username' => [__('weikit::auth.login.login_failed')],
            ]);
        }

        $this->clearRateLimiter();

        return $guard->user();
    }

    protected function form()
    {
        return Form::make([
            Input::make('username')
                     ->label(__('weikit::auth.login.username'))
                     ->required(),
            Input::make('password')
                     ->label(__('weikit::auth.login.password'))
                     ->password()
                     ->required(),
            Captcha::make()
                   ->label(__('weikit::captcha.input.label'))
                   ->url(captcha_src('math'))
                   ->required(),
            Grid::make([
                Toggle::make('remember')
                    ->label(__('weikit::auth.login.remember')),

            ])
        ], __('weikit::auth.login.submit'))
                   ->id('login_form')
                   ->url(route('admin.auth.login'));
    }

    protected function getSchema($form)
    {
        return Card::make()
                   ->title(__('weikit::auth.login.title'))
                   ->child($form);
    }


}
