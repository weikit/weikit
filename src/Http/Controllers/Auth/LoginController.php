<?php

namespace Weikit\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class LoginController extends BaseController
{

    public function page()
    {
        return view('weikit::auth.login');
    }

    public function api(Request $request)
    {
        // TODO error limit
        // TODO api token get
        $user = auth()->attempt($request->only(['username', 'password']), $request->remember);

        return $user;
    }
}
