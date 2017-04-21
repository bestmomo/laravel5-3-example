<?php

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        return Request::is($path) ? ' class="active"' : '';
    }
}

if (!function_exists('classActiveSegment')) {
    function classActiveSegment($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ' class="active"' : '';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return ' class="active"';
            }
        }
        return '';
    }
}

if (!function_exists('classActiveOnlyPath')) {
    function classActiveOnlyPath($path)
    {
        return Request::is($path) ? ' active' : '';
    }
}

if (!function_exists('classActiveOnlySegment')) {
    function classActiveOnlySegment($segment, $value)
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ' active' : '';
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) {
                return ' active';
            }
        }
        return '';
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format(config('app.locale') != 'en' ? 'd/m/Y H:i:s' : 'm/d/Y H:i:s');
    }
}

if (!function_exists('userValid')) {
    function userValid($id)
    {
        return \App\Models\User::findOrFail($id)->valid;
    }
}
