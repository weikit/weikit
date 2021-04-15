<?php

namespace Weikit\Component\Form\Traits;

/**
 * Trait CanBeAutocompleted
 * @package Weikit\Component\Form\Traits
 *
 * @property string $autocomplete
 */
trait CanBeAutocompleted
{
    public function disableAutocomplete()
    {
        $this->autocomplete('off');

        return $this;
    }

    public function autocomplete($autocomplete = 'on')
    {
        return $this->set('autocomplete', $autocomplete);
    }
}
