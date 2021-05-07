<?php


namespace Weikit\Component\Traits;


use Weikit\Component\Component;

/**
 * Trait HasParent
 * @package Weikit\Component\Traits
 * @property Component $parent
 */
trait HasParent
{
    private Component $_parent;

    /**
     * @param Component $parent
     *
     * @return $this
     */
    public function parent(Component $parent)
    {
        $this->_parent = $parent;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getParent()
    {
        return $this->_parent;
    }
}
