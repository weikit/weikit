<?php

if (! function_exists('weikit_path')) {
    function weikit_path($path = '')
    {
        return realpath(__DIR__ . '/../..') . $path;
    }
}
