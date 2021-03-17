<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Weikit\Http\Traits\HasRateLimiting;
use Weikit\Http\Controllers\Controller;

class LoginController extends Controller
{
    use HasRateLimiting;


    public function page()
    {
        return view('weikit::auth.login');
    }

    public function api(Request $request)
    {
        $this->rateLimit(5);

        $guard = auth();
        if (!$guard->attempt($request->only(['username', 'password']), $request->remember)) {
            throw ValidationException::withMessages([
                'username' => [__('weikit::auth.failed')],
            ]);
        }

        $this->clearRateLimiter();

        return $guard->user();
    }
}
