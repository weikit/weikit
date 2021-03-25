<?php

namespace Weikit\Components\Form;

class Radio extends Field
{
    use Concerns\CanBeAutofocused;

    protected function init()
    {
        $this->type('radio');
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
