<?php

namespace Weikit\Http\Controllers;

use Weikit\Services\Contracts\MenuService;

class DashboardController extends Controller
{
    public function layout(MenuService $service)
    {
        $menu = $service->one(['name' => 'admin'], [
            'with' => ['items']
        ]);

        return inertia('weikit::dashboard/layout',[
            'menu' => $menu
        ]);
    }

    public function index()
    {
        return inertia('weikit::dashboard/index');
    }
}
