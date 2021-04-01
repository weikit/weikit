<?php

namespace Weikit\Component\Forms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Weikit\Component\Component;

/**
 * Class Field
 * @package Weikit\Component\Form
 *
 * @property string $name
 * @property bool $disabled
 *
 * @property mixed $default
 * @property string $label
 * @property string $hint
 * @property string $helpMessage
 * @property bool $nullable
 * @property bool $required
 * @property string $requiredWith
 */
abstract class Field extends Component
{
    /**
     * Field constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        if ($name === null) {
            throw new \InvalidArgumentException('The property "name" must be set.');
        }
        $this->name($name);
        $this->label($name);

        parent::__construct();
    }

    /**
     * @param $name
     *
     * @return static
     */
    public static function make($name)
    {
        return new static($name);
    }

    /**
     * @param string $label
     *
     * @return Field
     */
    public function label(string $label)
    {
        return $this->set('label', $label);
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function name(string $name)
    {
        return $this->set('name', $name);
    }

    /**
     * @return $this
     */
    public function disabled()
    {
        return $this->set('disabled', true);
    }

    /**
     * @return $this
     */
    public function enabled()
    {
        return $this->set('disabled', false);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function value($value)
    {
        return $this->set('value', $value);
    }

    /**
     * @param $hint
     *
     * @return $this
     */
    public function hint($hint)
    {
        return $this->set('hint', $hint);
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    public function extra(string $key, $value)
    {
        return $this->set('extra.' . $key, $value);
    }

    /**
     * @return $this
     */
    public function required()
    {
        return $this->set('required', true)
                    ->removeRules([$this->name => ['nullable']])
                    ->addRules([$this->name => ['required']]);
    }

    /**
     * @param $field
     *
     * @return $this
     */
    public function requiredWith($field)
    {
        return $this->set('required', false)
                    ->removeRules([$this->name => ['nullable', 'required']])
                    ->addRules([$this->name => ["required_with:$field"]]);
    }

    /**
     * @return $this
     */
    public function nullable()
    {
        return $this->set('required', false)
                    ->removeRules([$this->name => ['required']])
                    ->addRules([$this->name => ['nullable']]);

    }

    public function getRules()
    {
        return $this->get('rules', []);
    }

    public function rule($field, $rule)
    {
        if (empty($rule)) {
            Arr::forget($this->data, 'rules.' . $field);
        } else {
            $this->set('rules.' . $field, $rule);
        }

        return $this;
    }

    /**
     * @param $rules
     *
     * @return $this
     */
    public function addRules($rules)
    {
        if ( ! is_array($rules)) {
            $rules = [$this->name => $rules];
        }

        foreach ($rules as $field => $conditionsToAdd) {
            if (is_numeric($field)) {
                $field = $this->name;
            }

            if ( ! is_array($conditionsToAdd)) {
                $conditionsToAdd = explode('|', $conditionsToAdd);
            }

            $rule = collect($this->rules[$field] ?? [])
                ->filter(function ($originalCondition) use ($conditionsToAdd) {
                    if ( ! is_string($originalCondition)) {
                        return true;
                    }

                    $conditionsToAdd = collect($conditionsToAdd);

                    if ($conditionsToAdd->contains($originalCondition)) {
                        return false;
                    }

                    if ( ! Str::of($originalCondition)->contains(':')) {
                        return true;
                    }

                    $originalConditionType = (string) Str::of($originalCondition)->before(':');

                    return ! $conditionsToAdd->contains(function ($conditionToAdd) use ($originalConditionType) {
                        return $originalConditionType === (string)Str::of($conditionToAdd)->before(':');
                    });
                })
                ->push(...$conditionsToAdd)
                ->toArray();

            $this->rule($field, $rule);
        }

        return $this;
    }

    /**
     * @param $rules
     *
     * @return $this
     */
    public function removeRules($rules)
    {
        if ( ! is_array($rules)) {
            $rules = [$this->name => $rules];
        }

        foreach ($rules as $field => $conditionsToRemove) {
            if (is_numeric($field)) {
                $field = $this->name;
            }

            if ( ! is_array($conditionsToRemove)) {
                $conditionsToRemove = explode('|', $conditionsToRemove);
            }

            $rule = null;

            if (!empty($conditionsToRemove)) {
                $rule = collect($this->rules[$field] ?? [])
                    ->filter(function ($originalCondition) use ($conditionsToRemove) {
                        if ( ! is_string($originalCondition)) {
                            return true;
                        }

                        $conditionsToRemove = collect($conditionsToRemove);

                        if ($conditionsToRemove->contains($originalCondition)) {
                            return false;
                        }

                        if ( ! Str::of($originalCondition)->contains(':')) {
                            return true;
                        }

                        $originalConditionType = (string)Str::of($originalCondition)->before(':');

                        return ! $conditionsToRemove->contains(function ($conditionToRemove) use ($originalConditionType) {
                            return $originalConditionType === (string)Str::of($conditionToRemove)->before(':');
                        });
                    })
                    ->toArray();
            }

            $this->rule($field, $rule);
        }

        return $this;
    }
}
