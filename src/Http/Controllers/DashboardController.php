<?php

namespace Weikit\Http\Controllers;

class DashboardController extends Controller
{
    public function layout()
    {
        return inertia('weikit::dashboard/layout');
    }

    public function index()
    {
        return inertia('weikit::dashboard/index');
    }
}
