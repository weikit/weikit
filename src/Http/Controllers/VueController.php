<?php

namespace Weikit\Http\Controllers;

class VueController
{
    public function __invoke($view)
    {
        return view($view);
    }
}
