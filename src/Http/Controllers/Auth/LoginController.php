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
        return view('weikit::auth.login', [
            'form' => $this->getForm()
        ]);
    }

    public function api(Request $request)
    {
        $this->rateLimit(5);

        $guard = auth();
        if ( ! $guard->attempt($request->only(['username', 'password']), $request->remember)) {
            throw ValidationException::withMessages([
                'username' => [__('weikit::auth.failed')],
            ]);
        }

        $this->clearRateLimiter();

        return $guard->user();
    }

    protected function getForm()
    {
        return Card::make()
            ->title(__('weikit::auth.login.title'))
            ->child(
                Form::make([
                    TextInput::make('username')
                         ->label('账号')
                         ->required(),
                    TextInput::make('password')
                         ->label('密码')
                         ->password()
                         ->required(),
                    Captcha::make()
                         ->label('验证码')
                         ->url(captcha_src('math'))
                         ->required(),
                ])
            );
    }
}
