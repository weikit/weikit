<?php

namespace Weikit\Component\Forms;

use Illuminate\Database\Eloquent\Model;
use Weikit\Component\Component;
use Weikit\Component\Traits\HasChildren;
use Weikit\Component\Traits\HasMakeChildren;

/**
 * Class Form
 * @package Weikit\Component\Form
 *
 * @property string $method
 * @property string $action
 */
class Form extends Component
{
    use HasChildren;
    use HasMakeChildren {
        HasMakeChildren::make as _make;
    }

    protected function init()
    {
        $this->method('POST');
        $this->action(url()->current());
    }

    public static function make(array $children = [], $button = null)
    {
        $instance = static::_make($children);

        if ($button !== false) {
            $button = new Button($button ?: __('weikit::component.form.button.label'));
            $button->type(Button::TYPE_SUBMIT);
            $instance->child($button);
        }

        return $instance;
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function method(string $method)
    {
        return $this->set('method', strtoupper($method));
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
}
