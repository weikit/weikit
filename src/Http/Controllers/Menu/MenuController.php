<?php

namespace Weikit\Http\Controllers\Menu;

use Illuminate\Http\Request;
use Weikit\Http\Controllers\Controller;
use Weikit\Services\Contracts\MenuService;

class MenuController extends Controller
{
    public function admin(Request $request, MenuService $service)
    {
        return $service->one(['name' => 'admin'], [
            'with' => ['items']
        ]);
    }
}
