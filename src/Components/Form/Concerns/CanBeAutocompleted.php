<?php

namespace Weikit\Components\Form\Concerns;

/**
 * Trait CanBeAutocompleted
 * @package Weikit\Components\Form\Concerns
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
