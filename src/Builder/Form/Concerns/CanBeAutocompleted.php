<?php

namespace Weikit\Builder\Form\Concerns;

/**
 * Trait CanBeAutocompleted
 * @package Weikit\Builder\Form\Concerns
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
