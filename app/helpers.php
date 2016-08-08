<?php

function is_path_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function str_titleize($value)
{
    $value = str_replace('-', ' ', $value);
    $value = str_replace('_', ' ', $value);
    return \Illuminate\Support\Str::title($value);
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

function blank_icon($value=null)
{
    return empty($value) ? '<i class="icon-cross2"></i>' : $value;
}

function is_complete_form($attributes)
{
    foreach ($attributes as $key => $value) {
        if (empty($value) && $key != 'deleted_at') {
            return false;
        }
    }

    return true;
}