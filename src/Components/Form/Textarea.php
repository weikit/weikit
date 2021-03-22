<?php

namespace Weikit\Components\Form;

/**
 * Class Textarea
 * @package Weikit\Components\Form
 *
 * @property numeric $cols
 * @property numeric $rows
 */
class Textarea extends Field
{
    use Concerns\CanBeAutocompleted;
    use Concerns\CanBeAutofocused;
    use Concerns\CanBeCompared;
    use Concerns\CanBeUnique;
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasPlaceholder;

    protected function init()
    {
        $this->type('textarea');
    }

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
