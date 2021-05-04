<?php

namespace Weikit\Component\Form;

class Input extends Field
{
    use Traits\CanBeAutocompleted;
    use Traits\CanBeAutofocused;
    use Traits\CanBeCompared;
    use Traits\CanBeUnique;
    use Traits\CanBeLengthConstrained;
    use Traits\HasPlaceholder;

    protected function init()
    {
        $this->text();
    }

    public function max($value)
    {
        $this->addRules([$this->name => ["max:$value"]]);

        return $this;
    }

    public function min($value)
    {
        $this->addRules([$this->name => ["min:$value"]]);

        return $this;
    }

    protected function type($type)
    {
        return $this->set('type', $type);
    }

    public function text()
    {
        return $this->type('text');
    }

    public function numeric()
    {
        $this->type('number');

        $this->addRules([$this->name => ['numeric']]);

        return $this;
    }

    public function email()
    {
        $this->type('email');

        $this->addRules([$this->name => ['email']]);

        return $this;
    }

    public function tel()
    {
        $this->type('tel');

        return $this;
    }

    public function password()
    {
        $this->type('password');

        return $this;
    }

    public function url()
    {
        $this->type('url');

        $this->addRules([$this->name => ['url']]);

        return $this;
    }
}
