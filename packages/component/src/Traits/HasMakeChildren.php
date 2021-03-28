<?php


namespace Weikit\Component\Traits;

trait HasMakeChildren
{
    /**
     * @return static
     */
    public static function make(array $children = [])
    {
        return (new static())
            ->children($children);
    }
}
