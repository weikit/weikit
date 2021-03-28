<?php

namespace Weikit\Component\Tabs;

use Weikit\Component\Component;
use Weikit\Component\Traits\HasMake;
use Weikit\Component\Traits\HasChildren;

class Tabs extends Component
{
    use HasMake;
    use HasChildren;

    /**
     * @param Tab $component
     *
     * @return $this
     */
    public function child(Tab $component)
    {
        $children = $this->children;
        $children[] = $component;
        return $this->set('children', $children);
    }
}
