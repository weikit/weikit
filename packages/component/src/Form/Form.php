<?php

namespace Weikit\Component\Form;

use Illuminate\Database\Eloquent\Model;
use Weikit\Component\Component;
use Weikit\Component\Base\Button;
use Weikit\Component\Traits\HasModel;
use Weikit\Component\Layout\Grid;
use Weikit\Component\Traits\HasChildren;

/**
 * Class Form
 * @package Weikit\Component\Form
 *
 * @property string $method
 * @property string $action
 * @property array $defaults
 * @property array $rules
 * @property array $validationAttributes
 * @property array $messages
 */
class Form extends Component
{
    use HasModel {
        HasModel::model as setModel;
    }
    use HasChildren;


    const SCENE_SUBMIT_CONFIRM = "submit_confirm";
    const SCENE_SUBMIT_CANCEL = "submit_cancel";
    const SCENE_SUBMIT_SUCCESS = "submit_success";
    const SCENE_RESET_CONFIRM = "reset_confirm";
    const SCENE_RESET_SUCCESS = "reset_success";
    const SCENE_RESET_CANCEL = "reset_cancel";

    protected function init()
    {
        $this->method('POST');
        $this->url(url()->current());
    }

    public static function make(array $children, $button = null)
    {
        $instance = new static();

        $instance->children($children);
        if ($button !== false) {
            $instance->child(Grid::make([
                Button::make($button ?: __('weikit::component.form.button.label'))
            ]));
        }

        return $instance;
    }

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function model(Model $model)
    {
        $this->setModel($model);

        $this->fillNestedFieldModel($this, $model);

        return $this;
    }

    /**
     * @param Component $parent
     * @param Model $model
     */
    protected function fillNestedFieldModel(Component $parent, Model $model)
    {
        foreach ($parent->components as $component) {
            if ($component instanceof Field) {
                $component->model($model);
            }

            if (count($component->components) > 0) {
                $this->fillNestedFieldModel($component, $model);
            }
        }
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
     * @param string $url
     *
     * @return $this
     */
    public function url(string $url)
    {
        return $this->set('url', $url);
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        return $this->flattenDefaults($this->children);
    }

    public function flattenDefaults(array $components)
    {
        $defaults = [];

        foreach ($components as $component) {
            if ($component instanceof Field) {
                $defaults = array_merge($defaults, $component->value);
            } elseif (!$component instanceof Form && !empty($component->children)) {
                $defaults = array_merge($defaults, $this->flattenDefaults($component->children));
            }
        }

        return $defaults;
    }

    /**
     * @return array
     */
    public function getValidationAttributes()
    {
        return $this->flattenValidationAttributes($this->children);
    }

    /**
     * @param Component[] $components
     *
     * @return array
     */
    protected function flattenValidationAttributes(array $components)
    {
        $attributes = [];

        foreach ($components as $component) {
            if ($component instanceof Field) {
                $attributes = array_merge($attributes, $component->getValidationAttributes());
            } elseif (!$component instanceof Form && !empty($component->children)) {
                $attributes = array_merge($attributes, $this->flattenValidationAttributes($component->children));
            }
        }

        return $attributes;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->flattenRules($this->children);
    }

    /**
     * @param Component[] $components
     *
     * @return array
     */
    protected function flattenRules(array $components)
    {
        $rules = [];

        foreach ($components as $component) {
            if ($component instanceof Field) {
                $rules = array_merge($rules, $component->getRules());
            } elseif (!$component instanceof Form && !empty($component->children)) {
                $rules = array_merge($rules, $this->flattenRules($component->children));
            }
        }

        return $rules;
    }

    /**
     * @param string $scene submit_confirm | submit_success | reset_confirm | reset_success
     * @param $message
     *
     * @return Form
     */
    public function message(string $scene, $message)
    {
        return $this->set('messages.' . $scene, $message);
    }

    /**
     * @param string $scene
     *
     * @return mixed
     */
    public function getMessage(string $scene)
    {
        return $this->get('messages.' . $scene, null);
    }
}
