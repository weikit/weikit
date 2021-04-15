<?php

namespace Weikit\Component\Form;

class Checkbox extends Field
{
    use Traits\CanBeAutofocused;

    protected function init()
    {
        $this->default(false);
    }
}
