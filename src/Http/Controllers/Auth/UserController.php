<?php

namespace Weikit\Http\Controllers\Auth;

use Weikit\Http\Controllers\Controller;

class UserController extends Controller
{
    public function api()
    {
        return auth()->user();
    }
}
