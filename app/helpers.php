<?php

function is_path($path)
{
    return call_user_func_array('Request::is', (array) $path);
}

function is_path_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function is_route_active($routeNamed, $active = 'active')
{
    $route = call_user_func_array('Route::getFacadeRoot', []);
    return $route->currentRouteName() === $routeNamed ? $active : '';
}

function str_titleize($value)
{
    $value = str_replace('-', ' ', $value);
    $value = str_replace('_', ' ', $value);
    return \Illuminate\Support\Str::title($value);
}

function alternator($args)
{
    static $i;

    if (func_num_args() === 0) {
        $i = 0;
        return '';
    }
    $args = func_get_args();
    return $args[($i++ % count($args))];
}

function flash_messages()
{
    $content = '';
    if (session('notice')) {
        $content .= '<script type="text/javascript">$(function() { flash.notice("'.session('notice').'"); });</script>';
    }

    if (session('alert')) {
        $content .= '<script type="text/javascript">$(function() { flash.alert("'.session('alert').'"); });</script>';
    }

    return $content;
}

function blank_icon($value = null)
{
    return empty($value) ? '<i class="icon-cross2"></i>' : $value;
}

function boolean_icon($value = false)
{
    return '<i class="icon-' . ($value ? 'checkmark3' : 'cross2') . '"></i>';
}

function body_classes($additional)
{
    $classes = is_array($additional) ? $additional : [$additional];
    $route   = Route::getCurrentRoute()->getAction();

    if(isset($route['controller']))
    {
        $current_controller = explode(
            '@',
            str_replace($route['namespace']. "\\", '', $route['controller'])
        )[0];
        $classes[] = str_slug(snake_case($current_controller));

        $current_action = explode(
            '@',
            str_replace($route['namespace']. "\\", '', $route['controller'])
        )[1];
        $classes[] = str_slug($current_action);
    }

    $classes[] = $route['as'];
    $classes[] = Auth::guest() ? 'guest' : 'logged-in';

    return implode(' ', $classes);
}

function is_complete_form($attributes)
{
    $ignore = ['created_at', 'updated_at', 'deleted_at'];
    foreach ($attributes->getAttributes() as $key => $value) {
        if (empty($value) && !in_array($key, $ignore)) {
            return false;
        }
    }

    return true;
}

function trim_trailing_zeroes($nbr)
{
    return strpos($nbr, '.') !==false ? rtrim(rtrim($nbr, '0'), '.') : $nbr;
}

function normalize_registration_number($string)
{
    $string = ltrim($string, '0');
    $string = str_replace('-', '', $string);
    return $string;
}

function get_initial($str, $length = 2)
{
    $initial = '';
    $str_part = explode(' ', $str);

    /* reset length if array length less than $length */
    if (count($str_part) < $length) {
        $length = count($str_part);
    }

    for ($i=0; $i < $length; $i++) {
        $initial .= substr($str_part[$i], 0, 1);
    }

    return $initial;
}

function setting($key, $default=null, $context=null)
{
    if($context)
    {
        $row = $context->settings()->whereKey($key)->first();
    }
    else
    {
        $row = \App\Setting::whereKey($key)->first();
    }

    if($row)
    {
        return $row->value;
    }
    else
    {
        return $default;
    }
}

function yearOptions()
{
    $first = \App\UserHistory::first()->created_at->format('Y');
    $last = \App\UserHistory::orderBy('created_at', 'desc')->first()->created_at->format('Y');
    return range($first, $last);
}
