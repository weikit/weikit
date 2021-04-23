<?php

namespace Weikit\Component\Table\Columns;


use Weikit\Component\Traits\HasChildren;

class Action extends Column
{
    use HasChildren;

    public static function make($name = 'action', $label = null)
    {
        if ($label === null) {
            $label = __('weikit::component.table.action.label');
        }

        return new static($name, $label);
    }

    public function searchable($searchable = false)
    {
        return $this->set('searchable', false);
    }

    public function sortable($sortable = false)
    {
        return parent::sortable(false);
    }
}
