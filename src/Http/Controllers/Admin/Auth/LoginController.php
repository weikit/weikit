<?php

namespace Weikit\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth;
use Illuminate\Routing\Controller as BaseController;


class LoginController extends BaseController
{

    public function page()
    {
        return view('weikit::admin.auth.login');
    }

    public function api(Request $request)
    {
        $user = auth()->attempt($request->only(['username', 'password']), $request->remember);

        return $user;
    }
}
