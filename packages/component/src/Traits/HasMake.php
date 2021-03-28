<?php

namespace Weikit\Component\Traits;


trait HasMake
{
    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }
}
