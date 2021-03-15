<?php

namespace Weikit\Http\Controllers\Menu;

use Weikit\Http\Controllers\Controller;

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
