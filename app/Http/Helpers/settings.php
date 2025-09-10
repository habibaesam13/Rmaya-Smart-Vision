<?php



if (!function_exists('all_settings')) {

    function all_settings()
    {
       return \App\Http\Settings\SettingSingleton::getInstance();
    }

}


