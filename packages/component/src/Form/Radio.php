<?php

namespace Weikit\Component\Form;

class Radio extends Field
{
    use Traits\CanBeAutofocused;

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
