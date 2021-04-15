<?php

namespace Weikit\Component\Form;

/**
 * Class Textarea
 * @package Weikit\Component\Form
 *
 * @property numeric $cols
 * @property numeric $rows
 */
class Textarea extends Field
{
    use Traits\CanBeAutocompleted;
    use Traits\CanBeAutofocused;
    use Traits\CanBeCompared;
    use Traits\CanBeUnique;
    use Traits\CanBeLengthConstrained;
    use Traits\HasPlaceholder;

    /**
     * @param $cols
     *
     * @return Textarea
     */
    public function cols($cols)
    {
        return $this->set('cols', $cols);
    }

    /**
     * @param $rows
     *
     * @return Textarea
     */
    public function rows($rows)
    {
        return $this->set('rows', $rows);
    }
}
