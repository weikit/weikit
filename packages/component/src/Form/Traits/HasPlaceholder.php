<?php

namespace Weikit\Component\Form\Traits;

/**
 * Trait HasPlaceholder
 * @package Weikit\Component\Form\Traits
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
