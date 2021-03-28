<?php

namespace Weikit\Component\Forms;

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
        $this->default(false);
    }

}
