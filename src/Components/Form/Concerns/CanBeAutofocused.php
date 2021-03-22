<?php

namespace Weikit\Components\Form\Concerns;

/**
 * Trait CanBeAutofocused
 * @package Weikit\Components\Form\Concerns
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
