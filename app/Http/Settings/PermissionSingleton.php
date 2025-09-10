<?php

namespace App\Http\Settings;

use App\Models\Role;
use App\Models\RoleModule;
use App\Models\Settings;


class PermissionSingleton
{
    private static $instance;
    private $settings;
    private $roles_modules;

    private function __construct()
    {
        // Prevent instantiation
    }

    public static function getInstance()

    {
        if (!self::$instance) {
            self::$instance = new PermissionSingleton();
            self::$instance->loadSettingDatabase();
        }
        return self::$instance;
    }

    private function loadSettingDatabase()
    {
        // Code to retrieve header and footer content from the database
        // Example:

        $this->roles_modules =    RoleModule::whereIn('role_id', auth()->user()->roles->pluck('id'))
            ->pluck('permissions', 'module_code')->toArray();

//        $this->siteSetting = (clone $this->settings)->where('key', 'site_setting')->first() ?->values;
//        $this->metaSetting = (clone $this->settings)->where('key', 'meta_setting')->first() ?->values;

    }
//here
    public function getRoleModule()
    {
        return $this->roles_modules;
    }
}
