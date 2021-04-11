<?php

namespace Weikit\Http\Controllers;

class VueController
{
    public function __invoke($view)
    {
        if (!preg_match('/[\/\:-_A-Za-z0-9]+/', $view)) {
            abort(404, 'Vue file not found.');
        }

        return view($view);
    }


}
