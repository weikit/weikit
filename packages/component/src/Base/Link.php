<?php

namespace Weikit\Component\Base;

use Weikit\Component\Component;

class Link extends Component
{

    public function __construct($url, $text)
    {
        $this->text($text);
        $this->url($url);

        parent::__construct();
    }

    public static function make($url, $text)
    {
        return new static($url, $text);
    }

    public function text($text)
    {
        return $this->set('text', $text);
    }

    public function url(string $url)
    {
        return $this->set('url', $url);
    }
}
