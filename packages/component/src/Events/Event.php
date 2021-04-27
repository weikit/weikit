<?php

namespace Weikit\Component\Events;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Weikit\Component\Component;
use Weikit\Component\Traits\HasData;

abstract class Event implements Arrayable, Jsonable, JsonSerializable
{
    use HasData;

    public function do($event, $action, Component $component)
    {
        return $this->set($event . '.' . $action, $component);
    }
}
