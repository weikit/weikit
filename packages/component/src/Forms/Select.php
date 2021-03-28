<?php

namespace Weikit\Component\Forms;

class Select extends Field
{
    use Traits\CanBeAutofocused;
    use Traits\CanBeCompared;
    use Traits\CanBeUnique;
    use Traits\HasPlaceholder;

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
