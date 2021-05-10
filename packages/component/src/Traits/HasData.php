<?php

namespace Weikit\Component\Traits;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;

trait HasData
{
    /**
     * @var array
     */
    protected $data;

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

        Arr::set($this->data, $key, $data);

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
        $data = $this->get($key, []);
        $data = array_merge([$value], $data);

        Arr::set($this->data, $key, $data);

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

    /**
     * @return array
     */
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
