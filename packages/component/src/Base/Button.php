<?php

namespace Weikit\Component\Base;

use Weikit\Component\Component;
use Weikit\Component\Dialog\Traits\HasDialog;

/**
 * Class Button
 * @package Weikit\Component\Form
 *
 * @property string $label
 * @property string $type
 */
class Button extends Component
{
    use HasDialog;

    const TYPE_SUBMIT = 'submit';
    const TYPE_RESET = 'reset';
    const TYPE_BUTTON = 'button';

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
        $this->type(self::TYPE_SUBMIT);
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
