<?php

namespace Weikit\Components;

use Weikit\Components\Concerns\HasChildren;
use Weikit\Components\Form\Field;

class Tab extends Component
{
    use HasChildren;

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
     * @return static
     */
    public static function make($name = null)
    {
        return new static($name);
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
     * @param string $label
     *
     * @return Field
     */
    public function label(string $label)
    {
        return $this->set('label', $label);
    }

}
