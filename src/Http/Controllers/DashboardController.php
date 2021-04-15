<?php

namespace Weikit\Http\Controllers;

use Weikit\Services\Contracts\MenuService;

class DashboardController extends Controller
{
    public function layout(MenuService $service)
    {
        return inertia('weikit::dashboard/layout');
    }

    public function index()
    {
        return inertia('weikit::dashboard/index');
    }
}
