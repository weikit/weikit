<?php

namespace Weikit\Component;

use Illuminate\Support\Str;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Tappable;
use Illuminate\Contracts\Support\Arrayable;

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

    /**
     * @var array
     */
    protected $data;

    public function __construct()
    {
        if ($this->key === null) {
            $this->key(Str::camel(class_basename(get_class($this))));
        }

        $this->init();
    }

    protected function init()
    {
    }

    /**
     * @param $key
     *
     * @return $this
     */
    protected function key($type)
    {
        $this->data['key'] = $type;

        return $this;
    }

    public function getKey()
    {
        return $this->data['key'] ?? null;
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
     * @param $value
     *
     * @return $this
     */
    protected function append(string $key, $value)
    {
        $data = $this->get($key, []);
        $data[] = $value;

        return $this->set($key, $data);
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    protected function prepend(string $key, $value)
    {
        $data = $this->get($key, []);
        $data = array_merge([$value], $data);

        return $this->set($key, $data);
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

    /**
     * @param array $data
     *
     * @return array
     */
    private function mapArray($data)
    {
        return collect($data)->map(function ($value) {
            if (is_array($value)) {
                return $this->mapArray($value);
            }

            return $value instanceof Arrayable ? $value->toArray() : $value;
        })->all();
    }

    public function toArray()
    {
        return $this->mapArray($this->data);
    }

    public function toJson($options = 256)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException('JSON encoding error.');
        }

        return $json;
    }

}
