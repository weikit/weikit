<?php

namespace Weikit\Builder\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Weikit\Builder\Component;

class Form extends Component
{
    /**
     * @var string[]
     */
    public $rules = [];
    /**
     * @var Field[]
     */
    public $schema = [];

    /**
     * @param $method
     *
     * @return $this
     */
    public function method(string $method)
    {
        Arr::set($this->settings, 'attributes.method', $method);

        return $this;
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function action(string $action)
    {
        Arr::set($this->settings, 'attributes.action', $action);

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        $defaults = [];

        foreach ($this->schema as $field) {
            $defaults = array_merge($defaults, $field->getDefaults());
        }

        return $defaults;
    }

    /**
     * @return string[]
     */
    public function getRules()
    {
        $rules = $this->rules;

        foreach ($this->schema as $field) {
            foreach ($field->getRules() as $name => $conditions) {
                $rules[$name] = array_merge($rules[$name] ?? [], $conditions);
            }
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function getValidationAttributes()
    {
        $attributes = [];

        foreach ($this->schema as $field) {
            $attributes = array_merge($attributes, $field->getValidationAttributes());
        }

        return $attributes;
    }

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function model($model)
    {
        $this->schema = collect($this->schema)
            ->map(function ($field) use ($model) {
                return $field->model($model);
            })
            ->toArray();

        return $this;
    }

    /**
     * @param array $rules
     *
     * @return $this
     */
    public function rules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @param Field[] $schema
     *
     * @return $this
     */
    public function schema(array $schema)
    {
        $this->schema = value($schema);

        return $this;
    }
}
