<?php

namespace Weikit\Http\Controllers\Api\Auth;

use Weikit\Http\Controllers\Controller;

class UserController extends Controller
{
    public function info()
    {
        return auth()->user();
    }
}
