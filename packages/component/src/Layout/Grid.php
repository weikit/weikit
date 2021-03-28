<?php

namespace Weikit\Component\Layout;

use Weikit\Component\Component;
use Weikit\Component\Traits\HasChildren;
use Weikit\Component\Traits\HasMakeChildren;

/**
 * Class Grid
 * @package Weikit\Component\Layout
 *
 * @property numeric $columns
 */
class Grid extends Component
{
    use HasChildren {
        child as _child;
    }
    use HasMakeChildren;

    public function child(Component $component)
    {
        $return = $this->_child($component);

        $this->set('columns', count($this->children));

        return $return;
    }

    public function getColumns()
    {
        return $this->get('columns', 0);
    }
}
