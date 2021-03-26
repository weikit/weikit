<?php

namespace Weikit\Components\Form;

/**
 * Class Toggle
 * @package Weikit\Components\Form
 *
 */
class Toggle extends Field
{
    use Concerns\CanBeAutofocused;

    protected function init()
    {
        $this->default(false);
    }

}
