<?php

namespace Weikit\Component\Forms;

class Checkbox extends Field
{
    use Traits\CanBeAutofocused;

    protected function init()
    {
        $this->default(false);
    }
}
