<?php

namespace Weikit\Component\Forms;

/**
 * Class DatePicker
 * @package Weikit\Component\Form
 *
 * @property string $displayFormat
 * @property string $format
 * @property string $maxDate
 * @property string $minDate
 */
class DatePicker extends Field
{
    use Traits\CanBeAutofocused;
    use Traits\CanBeCompared;
    use Traits\CanBeUnique;
    use Traits\HasPlaceholder;

}
