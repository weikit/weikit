<?php

namespace Weikit\Component\Base;

use Weikit\Component\Component;
use Weikit\Component\Dialog\Traits\HasDialog;

class Link extends Component
{
    use HasDialog;

    public function __construct($text, $url)
    {
        $this->text($text);
        $this->url($url);

        parent::__construct();
    }

    public static function make($text, $url)
    {
        return new static($text, $url);
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
