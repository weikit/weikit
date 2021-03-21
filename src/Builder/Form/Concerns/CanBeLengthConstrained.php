<?php

namespace Weikit\Builder\Form\Concerns;

/**
 * Trait CanBeLengthConstrained
 * @package Weikit\Builder\Form\Concerns
 *
 * @property numeric $maxLength
 * @property numeric $minLength
 */
trait CanBeLengthConstrained
{
    public function maxLength($length)
    {
        $this->set('maxLength', $length);

        $this->addRules([$this->name => ["max:{$this->maxLength}"]]);

        return $this;
    }

    public function minLength($length)
    {
        $this->set('minLength', $length);

        $this->addRules([$this->name => ["min:{$this->minLength}"]]);

        return $this;
    }
}
