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
        $this->displayFormat('F j, Y');
        $this->format('Y-m-d');
    }

    public function displayFormat($format)
    {
        return $this->set('displayFormat', $format);
    }

    public function format($format)
    {
        return $this->set('format', $format);
    }

    public function maxDate($date)
    {
        $this->set('maxDate', $date);

        $this->addRules([$this->name => ["before_or_equal:$date"]]);
        return $this;
    }

    public function minDate($date)
    {
        $this->set('minDate', $date);

        $this->addRules([$this->name => ["after_or_equal:$date"]]);

        return $this;
    }
}
