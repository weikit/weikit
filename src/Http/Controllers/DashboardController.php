<?php

namespace Weikit\Http\Controllers;

class DashboardController extends Controller
{
    public function page()
    {
        return view('weikit::dashboard');
    }
}
