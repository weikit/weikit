<?php

namespace Weikit\Http\Controllers;

use Illuminate\Http\Request;
use Weikit\Services\Contracts\MenuService;

class MenuController extends Controller
{
    public function api(Request $request, MenuService $service)
    {
        return $service->one(['name' => 'admin'], [
            'with' => ['items']
        ]);
    }
}
