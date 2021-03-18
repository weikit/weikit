<?php

namespace Weikit\Builder\Form\Concerns;

trait CanBeAutofocused
{
    public $autofocus = false;

    public function autofocus()
    {
        $this->autofocus = true;

        return $this;
    }
}
