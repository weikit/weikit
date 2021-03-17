<?php

namespace Weikit\Exceptions;

use Exception;

class TooManyRequestsException extends Exception
{
    public $component;

    public $ip;

    public $method;

    public $secondsUntilAvailable;

    public function __construct($component, $method, $ip, $secondsUntilAvailable)
    {
        $this->component = $component;
        $this->ip = $ip;
        $this->method = $method;
        $this->secondsUntilAvailable = $secondsUntilAvailable;

        parent::__construct(sprintf(
            'Too many requests from [%s] to method [%s] on component: [%s]. Retry in %d seconds.',
            $this->ip,
            $this->method,
            $this->component,
            $this->secondsUntilAvailable
        ));
    }
}
