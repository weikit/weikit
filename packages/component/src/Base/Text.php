<?php

namespace Weikit\Component\Base;

use Weikit\Component\Component;

class Text extends Component
{
    public function __construct($text)
    {
        $this->text($text);

        parent::__construct();
    }

    public static function make($text)
    {
        return new static($text);
    }

    public function text($text)
    {
        return $this->set('text', $text);
    }
}
