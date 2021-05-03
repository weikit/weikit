<?php

namespace Weikit\Component\Dialog\Traits;

use Weikit\Component\Dialog\Dialog;

trait HasDialog
{
    public function dialog(Dialog $dialog)
    {
        return $this->set('dialog', $dialog);
    }
}
