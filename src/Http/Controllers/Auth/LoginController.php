<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Weikit\Component\Card\Card;
use Weikit\Component\Forms\Captcha;
use Weikit\Component\Forms\Form;
use Weikit\Component\Forms\TextInput;
use Weikit\Http\Controllers\Controller;
use Weikit\Http\Traits\HasRateLimiting;

class LoginController extends Controller
{
    use HasRateLimiting;

    public function page()
    {
        $form = $this->getForm();

        return inertia('weikit::auth/login', [
            'schema' => $this->getSchema($form),
        ]);
    }

    public function login(Request $request)
    {
        $this->rateLimit(5);

        $guard = auth();
        if ( ! $guard->attempt($request->only(['username', 'password']), $request->remember)) {
            throw ValidationException::withMessages([
                'username' => [__('weikit::auth.login.login_failed')],
            ]);
        }

        $this->clearRateLimiter();

        return $guard->user();
    }

    protected function getForm()
    {
        return Form::make([
            TextInput::make('username')
                     ->label(__('weikit::auth.login.username'))
                     ->required(),
            TextInput::make('password')
                     ->label(__('weikit::auth.login.password'))
                     ->password()
                     ->required(),
            Captcha::make()
                   ->label(__('weikit::captcha.input.label'))
                   ->url(captcha_src('math'))
                   ->required(),
        ], __('weikit::auth.login.submit'))
                   ->id('login_form')
                   ->action(route('admin.auth.login'));
    }

    protected function getSchema($form)
    {
        return Card::make()
                   ->title(__('weikit::auth.login.title'))
                   ->child($form);
    }


}
