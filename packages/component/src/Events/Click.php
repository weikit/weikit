<?php

namespace Weikit\Component\Events;

use Weikit\Component\Component;

class Click extends Event
{
    public static function show(Component $component)
    {
        return (new static())
            ->do('click', 'show', $component);
    }
}
