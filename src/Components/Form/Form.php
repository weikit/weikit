<?php

namespace Weikit\Components\Form;

use Illuminate\Database\Eloquent\Model;
use Weikit\Components\Component;

/**
 * Class Form
 * @package Weikit\Components\Form
 *
 * @property string $method
 * @property string $action
 * @property Field[] $schema
 */
class Form extends Component
{

    protected function init()
    {
        $this->type('form');
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function method(string $method)
    {
        return $this->set('method', $method);
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function action(string $action)
    {
        return $this->set('action', $action);
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        $defaults = [];

        foreach ($this->schema as $field) {
            $defaults = array_merge($defaults, $field->default);
        }

        return $defaults;
    }

//    /**
//     * @return array
//     */
//    public function getValidationAttributes()
//    {
//        $attributes = [];
//
//        foreach ($this->schema as $field) {
//            $attributes = array_merge($attributes, $field->getValidationAttributes());
//        }
//
//        return $attributes;
//    }

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
     * @param Model $model
     *
     * @return $this
     */
    public function model($model)
    {
        $schema = collect($this->schema)
            ->map(function ($field) use ($model) {
                return $field->model($model);
            })
            ->toArray();

        return $this->schema($schema);
    }

    /**
     * @param Field[] $schema
     *
     * @return $this
     */
    public function schema(array $schema)
    {
        return $this->set('schema', value($schema));
    }

    /**
     * @return array
     */
    public function getSchema()
    {
        return $this->get('schema', []);
    }

    public function toArray()
    {
        return array_merge($this->data, ['schema' => collect($this->schema)->toArray()]);
    }
}
