<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Weikit\Builder\Form\Form;
use Weikit\Builder\Form\TextInput;
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
        return Form::make()
            ->schema([
                TextInput::make('username')
                    ->label('账号')
                    ->required(),
                TextInput::make('password')
                    ->label('密码')
                    ->password()
                    ->required(),
            ]);
    }
}
