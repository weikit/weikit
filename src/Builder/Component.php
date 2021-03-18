<?php

namespace Weikit\Builder;

use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Tappable;

abstract class Component
{
    use Tappable;

    /**
     * @var array
     */
    protected $settings = [];

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * @param array|string $classes
     *
     * @return $this
     */
    public function classes($classes)
    {
        Arr::set($this->settings, 'attributes.class', is_array($classes) ? implode(' ', $classes) : $classes);

        return $this;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function id(string $id)
    {
        Arr::set($this->settings, 'attributes.id', $id);

        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function extraAttribute(string $name, $value)
    {
        Arr::set($this->settings, 'extraAttributes.' . $name, $value);

        return $this;
    }
}
