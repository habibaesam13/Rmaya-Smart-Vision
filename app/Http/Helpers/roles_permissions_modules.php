<?php


use App\Models\RoleModule;


function getModules()
{
    $modules = array(
        "0" => array(
            'name' => 'الأندية',
            'code' => 'clubs', // i put it
            'single_name' => 'club',
            'url_module_title' => "clubs",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة"  ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'حذف'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation' ),
                "4" => array('can_do' => "clubs_weapons_view", 'can_do_label' => "club weapons -  اسلحة النادي"  , "can_do_label_ar" => 'club weapons -  اسلحة النادي'  , "can_do_label_en" => ''),
                "5" => array('can_do' => "clubs_weapons_add", 'can_do_label' => "Add club weapons -  اضافة سلاح نادي"  , "can_do_label_ar" => 'اضافة سلاح نادي'  , "can_do_label_en" => ''),
                "6" => array('can_do' => "clubs_weapons_edit", 'can_do_label' => "edit club weapons -  تعديل سلاح نادي"  , "can_do_label_ar" => 'تعديل سلاح نادي'  , "can_do_label_en" => ''),
                "7" => array('can_do' => "clubs_weapons_delete", 'can_do_label' => "Delete club weapons -  حذف سلاح نادي"  , "can_do_label_ar" => 'حذف سلاح نادي'  , "can_do_label_en" => ''),
                "8" => array('can_do' => "clubs_weapons_active", 'can_do_label' => "Active club weapons -  تفعيل سلاح نادي"  , "can_do_label_ar" => 'تفعيل سلاح نادي', "can_do_label_en" => ''),

//                "8" => array('can_do' => "view", 'can_do_label' => "view - قائمة"),

            )
        ),
        "1" => array(
            'name' => 'الأسلحة',
            'code' => 'weapons',//i put it
            'single_name' => 'weapon',
            'url_module_title' => "weapon",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" , "can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  "  , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف " , "can_do_label_ar" => 'حذف'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
            )
        ),
        "2" => array(
            'name' => 'المسجلين افراد',
            'code' => 'members',//i put it
            'single_name' => 'member',
            'url_module_title' => "members",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" , "can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  "  , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف " , "can_do_label_ar" => 'حذف'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "4" => array('can_do' => "print", 'can_do_label' => "Print - طباعة  " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'print'),
            )
        ),
         "3" => array(
            'name' => 'المسجلين فرق',
            'code' => 'members_groups',//i put it
            'single_name' => 'group',
            'url_module_title' => "members_groups",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  "  , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "1" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف " , "can_do_label_ar" => 'حذف'  , "can_do_label_en" => 'Delete'),
                "2" => array('can_do' => "show_mems", 'can_do_label' => "members - عرض الاعضاء  " , "can_do_label_ar" => 'عرض الاعضاء'  , "can_do_label_en" => 'members'),
                "3" => array('can_do' => "print", 'can_do_label' => "Print - طباعة  " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'print'),
                "4" => array('can_do' => "rpt", 'can_do_label' => "Report - تقرير الفرق  " , "can_do_label_ar" => 'تقرير الفرق'  , "can_do_label_en" => 'report'),
            )
        ),

  "4" => array(
            'name' => ' لوحة تحكم الاندية',
            'code' => 'club_panel',//i put it
            'single_name' => 'club_panel',
            'url_module_title' => "club_panel",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "reg", 'can_do_label' => " Register - تسجيل داخلي  "  , "can_do_label_ar" => 'تسجيل داخلي'  , "can_do_label_en" => 'Register'),
                "1" => array('can_do' => "club_mem", 'can_do_label' => "Club member - المسجلين  " , "can_do_label_ar" => 'المسجلين'  , "can_do_label_en" => 'members'),
                "2" => array('can_do' => "add_res_rpt", 'can_do_label' => "Add result rpt - اضافة تقرير نتائج اولية   " , "can_do_label_ar" => 'اضافة تقرير نتائج اولية '  , "can_do_label_en" => 'Add result rpt'),
                "3" => array('can_do' => "absents", 'can_do_label' => "member - المتغيبين  " , "can_do_label_ar" => 'المتغيبين'  , "can_do_label_en" => 'members'),
            )
        ),
        
         "5" => array(
            'name' => ' تقرير النتائج النهائية',
            'code' => 'final_results',//i put it
            'single_name' => 'final_results',
            'url_module_title' => "final_results",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "mem", 'can_do_label' => "Members - المسجلين  " , "can_do_label_ar" => 'المسجلين'  , "can_do_label_en" => 'members'),
                "1" => array('can_do' => "add_res_rpt", 'can_do_label' => "Add result rpt - اضافة تقرير نتائج اولية   " , "can_do_label_ar" => 'اضافة تقرير نتائج اولية '  , "can_do_label_en" => 'Add result rpt'),
                "2" => array('can_do' => "final_results", 'can_do_label' => "Final results - نتيجة التصفيات النهائية  " , "can_do_label_ar" => 'نتيجة التصفيات النهائية'  , "can_do_label_en" => 'Final results'),
                "3" => array('can_do' => "absents", 'can_do_label' => "member - المتغيبين  " , "can_do_label_ar" => 'المتغيبين'  , "can_do_label_en" => 'members'),

            )
        ),

        
        
 "11" => array(
            'name' => 'Users',
            'code' => 'users',//i put it
            'single_name' => 'users',
            'url_module_title' => "users",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "show", 'can_do_label' => " View - عرض  "),
                "1" => array('can_do' => "add", 'can_do_label' => " add - اضافة  "),
                "2" => array('can_do' => "edit", 'can_do_label' => " edit - تعديل  "),
                "3" => array('can_do' => "delete", 'can_do_label' => " delete - حذف  "),
                "4" => array('can_do' => "view_roles", 'can_do_label' => " View role- عرض الجروبات   "),
                "5" => array('can_do' => "add_role", 'can_do_label' => " Add role - اضافة جروب  "),
                "6" => array('can_do' => "edit_role", 'can_do_label' => " edit role -  تعديل جروب  "),
				"7" => array('can_do' => "delete_role", 'can_do_label' => "delete role - حذف جروب   "),
                "8" => array('can_do' => "roles_perm", 'can_do_label' => "  role permissions - صلاحيات الجروب   "),

            )
        ),
     
          "12" => array(
            'name' => 'Settings',
            'code' => 'settings',//i put it
            'single_name' => 'Setting',
            'url_module_title' => "settings",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
            )
        ),
       

        "13" => array(
            'name' => 'Logs',
            'code' => 'logs',//i put it
            'single_name' => 'Log',
            'url_module_title' => "logs",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "1" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),

            )
        ),

     




    );

    return $modules;
}

//
//
//function checkUserHasRoleHasModule()
//{
//    if (!auth()->check()) {
//        return null;
//    }
//    $role_module = RoleModule::whereIn('role_id', auth()->user()->roles()->pluck('id'))
//        ->pluck('module_code')->toArray();
//    return $role_module;
//}
//
//
//function checkModule($module)
//{
//    if (!auth()->check()) {
//        return null;
//    }
//    return in_array($module, checkUserHasRoleHasModule());
//}


//if (!function_exists('checkModulePermission')) {
//
//    function checkModulePermission($module, $permission)
//    {
//        if (!auth()->check()) {
//            return null;
//        }
//        $role_module = RoleModule::whereIn('role_id', auth()->user()->roles->pluck('id'))
//            ->pluck('permissions', 'module_code')->toArray();
//
//
//        return in_array($module, array_keys($role_module)) && in_array($permission, explode(',', $role_module[$module]));
//    }

if (!function_exists('checkModulePermission')) {

    function checkModulePermission($module, $permission)
    {
        if (!auth()->check()) {
            return null;
        }
        $role_module = \App\Http\Settings\PermissionSingleton::getInstance()->getRoleModule();


        return in_array($module, array_keys($role_module)) && in_array($permission, explode(',', $role_module[$module]));
    }



//{{dd(\App\Http\Helpers\checkModulePermission('teachers' , 'update')
//)}}
}


