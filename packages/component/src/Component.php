<?php

namespace Weikit\Component;

use JsonSerializable;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Tappable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Weikit\Component\Events\Event;
use Weikit\Component\Traits\HasData;
use Weikit\Component\Traits\HasParent;

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
    use HasParent;
    use HasData {
        HasData::set as setData;
        HasData::append as appendData;
        HasData::prepend as prependData;
    }

    /**
     * @var Component[]
     */
    public $components = [];

    public function __construct()
    {
        if ($this->component === null) {
            $this->component(Str::camel(class_basename(get_class($this))));
        }

        $this->init();
    }

    protected function init()
    {

    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    protected function set(string $key, $value)
    {
        $this->setData($key, $value);

        // We can do lot things by map child components
        if ($value instanceof Component) {
            // make current component as parent component
            $this->components[] = $value->parent($this);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    protected function append(string $key, $value)
    {
        $this->appendData($key, $value);

        // We can do lot things by map child components
        if ($value instanceof Component) {
            // make current component as parent component
            $this->components[] = $value->parent($this);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    protected function prepend(string $key, $value)
    {
        $this->prependData($key, $value);

        // We can do lot things by map child components
        if ($value instanceof Component) {
            // make current component as parent component
            $this->components[] = $value->parent($this);
        }

        return $this;
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
