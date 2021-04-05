<?php

namespace Weikit\Component\Forms;

use Weikit\Component\Component;

/**
 * Class Button
 * @package Weikit\Component\Form
 *
 * @property string $label
 * @property string $type
 */
class Button extends Component
{
    const TYPE_SUBMIT = 'SUBMIT';
    const TYPE_RESET = 'RESET';
    const TYPE_BUTTON = 'BUTTON';

    public function __construct(string $label)
    {
        $this->label($label);

        parent::__construct();
    }

    /**
     * @param string $label
     *
     * @return static
     */
    public static function make(string $label)
    {
        return new static($label);
    }

    public function init()
    {
        $this->type(self::TYPE_BUTTON);
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function type($type)
    {
        return $this->set('type', $type);
    }

    /**
     * @param $label
     *
     * @return $this
     */
    public function label($label)
    {
        return $this->set('label', $label);
    }
}