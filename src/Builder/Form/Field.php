<?php

namespace Weikit\Builder\Form;

use Illuminate\Support\Arr;
use Weikit\Builder\Component;

abstract class Field extends Component
{
    public function name(string $name)
    {
        Arr::set($this->settings, 'attributes.name', $name);

        return $this;
    }

    public function default($default)
    {
        Arr::set($this->settings, 'default', $default);

        return $this;
    }

    public function hint($hint)
    {
        Arr::set($this->settings, 'hint', $hint);

        return $this;
    }

    public function helpMessage($message)
    {
        Arr::set($this->settings, 'helpMessage', $message);

        return $this;
    }

    public function disabled()
    {
        Arr::set($this->settings, 'disabled', true);

        return $this;
    }

    public function enabled()
    {
        Arr::set($this->settings, 'disabled', false);

        return $this;
    }
}
