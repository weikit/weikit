<?php

namespace Weikit\Builder\Form\Concerns;

/**
 * Trait CanBeAutofocused
 * @package Weikit\Builder\Form\Concerns
 *
 * @property bool $autofocus
 */
trait CanBeAutofocused
{
    public function autofocus()
    {
        return $this->set('autofocus', true);
    }
}
