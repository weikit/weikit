<?php

namespace Weikit\Components\Form;

class Checkbox extends Field
{
    use Concerns\CanBeAutofocused;

    protected function init()
    {
        $this->type('checkbox');
        $this->default(false);
    }
}
