<?php

namespace Weikit\Component\Forms\Traits;

/**
 * Trait CanBeCompared
 * @package Weikit\Component\Form\Traits
 */
trait CanBeCompared
{
    public function confirmed($confirmationFieldName = null)
    {
        if ($confirmationFieldName === null) $confirmationFieldName = "{$this->name}Confirmation";

        $this->addRules([$confirmationFieldName => ["same:$this->name"]]);

        return $this;
    }

    public function same($field)
    {
        $this->addRules([$this->name => ["same:$field"]]);

        return $this;
    }
}
