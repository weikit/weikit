<?php

namespace Weikit\Http\Controllers;

class ListController extends Controller
{

    public function page()
    {
        return view('weikit::menu.list');
    }

    public function api()
    {
        return [];
    }
}
