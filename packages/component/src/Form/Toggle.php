<?php

namespace Weikit\Component\Form;

/**
 * Class Toggle
 * @package Weikit\Component\Form
 *
 */
class Toggle extends Field
{
    use Traits\CanBeAutofocused;

    protected function init()
    {
        $this->value(false);
    }

}
