<?php

function is_path_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function is_route_active($routeNamed, $active = 'active')
{
    $route = call_user_func_array('Route::getFacadeRoot', []);
    return $route->currentRouteName() === $routeNamed ? $active : '';
}

/**
 * Titleize the given value
 * @param  String $value
 * @return String
 */
function str_titleize($value)
{
    $value = str_replace('-', ' ', $value);
    $value = str_replace('_', ' ', $value);
    return \Illuminate\Support\Str::title($value);
}

if (! function_exists('alternator')) {
    /**
     * Alternator
     *
     * Allows strings to be alternated. See docs...
     *
     * @param string (as many parameters as needed)
     * @return string
     */
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

function body_classes($additional)
{
    $current_route      = Route::getCurrentRoute()->getAction();
    $current_controller = explode(
        '@',
        str_replace($current_route['namespace']. "\\", '', $current_route['controller'])
    )[0];

    $current_action = explode(
        '@',
        str_replace($current_route['namespace']. "\\", '', $current_route['controller'])
    )[1];

    $classes = is_array($additional) ? $additional : [$additional];
    $classes[] = str_slug(snake_case($current_controller));
    $classes[] = str_slug($current_action);
    $classes[] = $current_route['as'];
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
