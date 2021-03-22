<?php

namespace Weikit\Components\Form\Concerns;

/**
 * Trait HasPlaceholder
 * @package Weikit\Components\Form\Concerns
 *
 * @property string $placeholder
 */
trait HasPlaceholder
{
    public function placeholder($placeholder)
    {
        return $this->set('placeholder', $placeholder);
    }
}
