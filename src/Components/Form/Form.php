<?php

namespace Weikit\Components\Form;

use Illuminate\Database\Eloquent\Model;
use Weikit\Components\Component;
use Weikit\Components\Concerns\HasChildren;

/**
 * Class Form
 * @package Weikit\Components\Form
 *
 * @property string $method
 * @property string $action
 */
class Form extends Component
{
    use HasChildren;
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

        foreach ($this->children as $field) {
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
//        foreach ($this->children as $field) {
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

        foreach ($this->children as $field) {
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
        $children = collect($this->children)
            ->map(function ($field) use ($model) {
                return $field->model($model);
            })
            ->toArray();

        return $this->children($children);
    }

    public function toArray()
    {
        return array_merge($this->data, ['children' => collect($this->children)->toArray()]);
    }
}
