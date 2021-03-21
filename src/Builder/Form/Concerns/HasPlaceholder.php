<?php

namespace Weikit\Builder\Form\Concerns;

/**
 * Trait HasPlaceholder
 * @package Weikit\Builder\Form\Concerns
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
