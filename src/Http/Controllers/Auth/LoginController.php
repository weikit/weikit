<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Weikit\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function page()
    {
        return view('weikit::auth.login');
    }

    public function api(Request $request)
    {
        $guard = auth();
        // TODO error limit
        // TODO api token get
        $successed = $guard->attempt($request->only(['username', 'password']), $request->remember);

        return $guard->user();
    }
}
