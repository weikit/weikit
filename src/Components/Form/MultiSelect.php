<?php

namespace Weikit\Components\Form;

class MultiSelect extends Field
{
    use Concerns\CanBeAutofocused;
    use Concerns\HasPlaceholder;

    public $emptyOptionsMessage = 'forms::fields.multiSelect.emptyOptionsMessage';

    public $noSearchResultsMessage = 'forms::fields.multiSelect.noSearchResultsMessage';

    public $options = [];

    public function __construct($name)
    {
        parent::__construct($name);

        $this->placeholder('forms::fields.multiSelect.placeholder');
    }

    public function emptyOptionsMessage($message)
    {
        $this->emptyOptionsMessage = $message;

        return $this;
    }

    public function noSearchResultsMessage($message)
    {
        $this->noSearchResultsMessage = $message;

        return $this;
    }

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }
}
