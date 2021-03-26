<?php

namespace Weikit\Components;

use Weikit\Components\Concerns\HasChildren;

class Tabs extends Component
{
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
