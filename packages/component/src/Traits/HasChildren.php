<?php

namespace Weikit\Component\Traits;

use Weikit\Component\Component;

/**
 * Trait HasSchema
 * @package Weikit\Component\Form\Traits
 *
 * @property Component[] $children
 */
trait HasChildren
{
    /**
     * @param array $components
     *
     * @return $this
     */
    public function children(array $components)
    {
        foreach($components as $component) {
            $this->child($component);
        }

        return $this;
    }

    /**
     * @param Component $component
     *
     * @return $this
     */
    public function child(Component $component)
    {
        return $this->append('children', $component);
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->get('children', []);
    }
}
