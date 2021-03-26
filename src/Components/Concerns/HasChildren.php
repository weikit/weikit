<?php

namespace Weikit\Components\Concerns;

use Weikit\Components\Component;

/**
 * Trait HasSchema
 * @package Weikit\Components\Form\Concerns
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
        $children = $this->children;
        $children[] = $component;
        return $this->set('children', $children);
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->get('children', []);
    }
}
