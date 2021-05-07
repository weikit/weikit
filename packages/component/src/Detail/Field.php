<?php

namespace Weikit\Component\Detail;

use Weikit\Component\Base\Text;
use Weikit\Component\Component;
use Weikit\Component\Traits\HasChildren;

class Field extends Component
{
    use HasChildren;

    public function __construct(string $label, $field)
    {
        $this->label($label);
        $this->field(!$field instanceof Component ? Text::make($field) : $field);
        $this->component('detailField');

        parent::__construct();
    }

    public static function make(string $label, $field)
    {
        return new static($label, $field);
    }

    public function label(string $label)
    {
        return $this->set('label', $label);
    }

    public function field(Component $field)
    {
        return $this->set('field', $field);
    }
}
