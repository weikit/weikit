<?php

namespace Weikit\Component\Table;

use Illuminate\Support\Str;
use Weikit\Component\Component;

/**
 * Class Column
 * @package Weikit\Component\Table
 * @property string $name
 * @property string $label
 * @property boolean $primary
 * @property boolean $searchable
 * @property boolean $sortable
 * @property boolean $hidden
 */
class Column extends Component
{
    public function __construct($name)
    {
        $this->name($name);

        parent::__construct();
    }

    public static function make($name)
    {
        return new static($name);
    }

    public function name($name)
    {
        if ($this->label === null) {
            $this->label(
                (string) Str::of($this->name)
                            ->kebab()
                            ->replace(['-', '_', '.'], ' ')
                            ->ucfirst(),
            );
        }
        return $this->set('name', $name);
    }

    public function label($label)
    {
        return $this->set('label', $label);
    }

    public function primary()
    {
        return $this->set('primary', true);
    }

    public function searchable()
    {
        return $this->set('searchable', true);
    }

    public function sortable()
    {
        return $this->set('sortable', true);
    }

    public function hidden()
    {
        return $this->set('hidden', true);
    }

    public function visible()
    {
        return $this->set('hidden', false);
    }
}
