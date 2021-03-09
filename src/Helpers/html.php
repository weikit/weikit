<?php

if (! function_exists('format_attributes')) {
    function format_attributes($attributes = [])
    {
        return collect($attributes)
            ->map(fn ($value, $key) => "{$key}={$value}")
            ->join(' ');
    }
}
