<?php

namespace Weikit\Http\Controllers;

use Illuminate\Support\Facades\Log;

class VueController
{

    public function __invoke($view)
    {
        // TODO  only support .vue file
        try {

            if (!preg_match('/[\/\:-_A-Za-z0-9]+/', $view)) {
                throw new \InvalidArgumentException($view . ' is not valid view path');
            }

            return view($view);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            abort(404, 'Vue file not found.');
        }
    }
}
