<?php

namespace Weikit\Components\Form;

class Radio extends Field
{
    use Concerns\CanBeAutofocused;

    protected function init()
    {
        $this->type('radio');
    }

}
