<?php

namespace Weikit\Components\Form;

class Checkbox extends Field
{
    use Concerns\CanBeAutofocused;

    public function __construct($name)
    {
        parent::__construct($name);

        $this->default(false);
    }
}
