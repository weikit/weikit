<?php

namespace Weikit\Http\Controllers;

use Illuminate\View\ViewName;
use Illuminate\View\Factory as ViewFactory;

class VueController
{

    public function __invoke(ViewFactory $factory, string $view)
    {
        try {
            if (!preg_match('/[\/\:-_A-Za-z0-9]+/', $view)) {
                throw new \InvalidArgumentException('Incorrect VUE file format.');
            }

            $file = $factory->getFinder()->find(ViewName::normalize($view));
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            // only support vue file
            if ($extension !== 'vue') {
                throw new \InvalidArgumentException('Vue file not found.');
            }

            return response($factory->file($file), 200)
                ->setLastModified(\DateTime::createFromFormat('U', (string) filemtime($file)));
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
