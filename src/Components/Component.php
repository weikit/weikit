<?php

namespace Weikit\Components;

use Illuminate\Support\Str;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Tappable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Component
 * @package Weikit\Components
 *
 * @property string $id
 * @property string $class
 * @property string $type
 */
abstract class Component implements Arrayable, Jsonable, JsonSerializable
{
    use Tappable;

    /**
     * @var array
     */
    protected $data = [];

    public function __construct()
    {
        $this->init();

        if ($this->type === null) {
            $this->type(Str::camel(class_basename(get_class($this))));
        }
    }

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    protected function init()
    {
    }

    /**
     * @param $type
     *
     * @return $this
     */
    protected function type($type)
    {
        $this->data['type'] = $type;

        return $this;
    }

    public function getType()
    {
        return $this->data['type'] ?? null;
    }

    /**
     * @param array|string $class
     *
     * @return $this
     */
    public function className($class)
    {
        return $this->set('className', is_array($class) ? implode(' ', value($class)) : $class);
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
     * @param $key
     * @param $value
     *
     * @return $this
     */
    protected function set(string $key, $value)
    {
        Arr::set($this->data, $key, $value);

        return $this;
    }

    /**
     * @param string $key
     * @param $default
     *
     * @return mixed
     */
    protected function get(string $key, $default)
    {
        return Arr::get($this->data, $key, $default);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        if (method_exists($this, 'get' . $key)) {
            return $this->{'get' . $key}();
        }

        return $this->data[$key] ?? null;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return collect($this->data)
            ->toArray();
    }

    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException('JSON encoding error.');
        }

        return $json;
    }

}
