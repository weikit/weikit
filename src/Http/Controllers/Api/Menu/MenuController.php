<?php

namespace Weikit\Http\Controllers\Api\Menu;

use Weikit\Http\Controllers\Controller;
use Weikit\Services\MenuService;

class MenuController extends Controller
{
    public function admin(MenuService $service)
    {
        return $service->one(['name' => 'admin'], [
            'with' => ['items']
        ]);
    }
}
