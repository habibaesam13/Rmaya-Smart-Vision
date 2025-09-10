<?php

namespace App\Http\Settings;

use App\Models\Settings;
use App\Models\SiteSettings;


class SettingSingleton
{
    private static $instance;
     private $siteSetting, $colorsSetting, $giftSetting, $metaSetting;

    private function __construct()
    {
        // Prevent instantiation
    }

    public static function getInstance()

    {
        if (!self::$instance) {
            self::$instance = new SettingSingleton();
            self::$instance->loadSettingDatabase();
        }
        return self::$instance;
    }

    private function loadSettingDatabase()
    {
        // Code to retrieve header and footer content from the database
        // Example:

        $this->siteSetting = SiteSettings::first();


    }

    public function getSiteSetting()
    {
        return $this->siteSetting;
    }




    public function getItem($val)
    {
        $value = "";
        if ($this->siteSetting) {
            $value = $this->siteSetting?->$val;
        }
        return $value;
    }


}
