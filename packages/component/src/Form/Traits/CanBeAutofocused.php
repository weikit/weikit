<?php

namespace Weikit\Component\Form\Traits;

/**
 * Trait CanBeAutofocused
 * @package Weikit\Component\Form\Traits
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
