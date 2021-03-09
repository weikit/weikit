<?php

namespace Weikit\Components\Form;

class TagsInput extends Field
{
    use Concerns\CanBeAutofocused;
    use Concerns\CanBeCompared;
    use Concerns\CanBeUnique;
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasPlaceholder;

    public $separator = ',';

    public function __construct($name)
    {
        parent::__construct($name);

        $this->placeholder('forms::fields.tags.placeholder');
    }

    public function separator($separator)
    {
        $this->separator = $separator;

        return $this;
    }
}
