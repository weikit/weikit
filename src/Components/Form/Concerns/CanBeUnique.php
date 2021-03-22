<?php

namespace Weikit\Components\Form\Concerns;

/**
 * Trait CanBeUnique
 * @package Weikit\Components\Form\Concerns
 */
trait CanBeUnique
{
    public function unique($table, $column = null, $exceptCurrentRecord = false)
    {
        $rule = "unique:$table,$column";
        if ($exceptCurrentRecord) $rule .= ',{{record}}';

        $this->addRules([$this->name => [$rule]]);

        return $this;
    }
}
