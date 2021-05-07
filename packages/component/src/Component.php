<?php

namespace Weikit\Component;

use JsonSerializable;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Tappable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Weikit\Component\Events\Event;
use Weikit\Component\Traits\HasData;

/**
 * Class Component
 * @package Weikit\Component
 *
 * @property string $id
 * @property string $class
 * @property string $key
 */
abstract class Component implements Arrayable, Jsonable, JsonSerializable
{
    use Tappable;
    use HasData;

    public function __construct()
    {
        if ($this->key === null) {
            $this->component(Str::camel(class_basename(get_class($this))));
        }

        $this->init();
    }

    protected function init()
    {

    }

    /**
     * @param $component
     *
     * @return $this
     */
    protected function component(string $component)
    {
        $this->set('component', $component);
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function id(string $id)
    {
        return $this->set('id', $id);
    }

    /**
     * @param array|string $class
     *
     * @return $this
     */
    public function classes($classes)
    {
        return $this->set('classes', !is_array($classes) ? $classes : [$classes]);
    }

    /**
     * @param array|string $styles
     *
     * @return $this
     */
    public function styles($styles)
    {
        return $this->set('styles', !is_array($styles) ? $styles : [$styles]);
    }

    /**
     * @param Event $event
     *
     * @return $this
     */
    public function event(Event $event)
    {
        return $this->append('events', $event);
    }

}
