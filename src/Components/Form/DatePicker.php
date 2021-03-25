<?php

namespace Weikit\Components\Form;

/**
 * Class DatePicker
 * @package Weikit\Components\Form
 *
 * @property string $displayFormat
 * @property string $format
 * @property string $maxDate
 * @property string $minDate
 */
class DatePicker extends Field
{
    use Concerns\CanBeAutofocused;
    use Concerns\CanBeCompared;
    use Concerns\CanBeUnique;
    use Concerns\HasPlaceholder;

    protected function init()
    {
        $this->type('datePicker');
    }


}
