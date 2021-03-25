<?php

namespace Weikit\Components\Form;

class Select extends Field
{
    use Concerns\CanBeAutofocused;
    use Concerns\CanBeCompared;
    use Concerns\CanBeUnique;
    use Concerns\HasPlaceholder;

    public function init()
    {
        $this->type('select');
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options(array $options)
    {
        return $this->set('options', $options);
    }
}
