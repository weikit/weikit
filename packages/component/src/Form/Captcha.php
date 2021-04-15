<?php

namespace Weikit\Component\Form;

/**
 * Class Captcha
 * @package Weikit\Component\Form
 *
 * @property string $url
 */
class Captcha extends Field
{
    public static function make($name = 'captcha')
    {
        return new static($name);
    }

    protected function init()
    {
        $this->url('/captcha');
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function url($url)
    {
        return $this->set('url', $url);
    }

    public function required()
    {
        return parent::required()
            ->addRules([$this->name => ['captcha']]);
    }
}
