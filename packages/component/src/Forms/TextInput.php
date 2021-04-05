<?php

namespace Weikit\Component\Forms;

class TextInput extends Field
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

    public function text()
    {
        return $this->key('text');
    }

    public function numeric()
    {
        $this->type('number');

        $this->addRules([$this->name => ['numeric']]);

        return $this;
    }

    public function email()
    {
        $this->key('email');

        $this->addRules([$this->name => ['email']]);

        return $this;
    }

    public function tel()
    {
        $this->key('tel');

        return $this;
    }

    public function password()
    {
        $this->key('password');

        return $this;
    }

    public function url()
    {
        $this->key('url');

        $this->addRules([$this->name => ['url']]);

        return $this;
    }
}
