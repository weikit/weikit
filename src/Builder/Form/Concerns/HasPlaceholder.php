<?php

namespace Weikit\Builder\Form\Concerns;

trait HasPlaceholder
{
    public $placeholder;

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
