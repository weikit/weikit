<?php

namespace Weikit\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;

class AuthenticateWithAdmin extends Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.auth.login.page');
        }
    }
}
