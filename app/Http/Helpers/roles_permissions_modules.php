<?php

//$modules_array = array(
//    "0"=>array(
//        'name' =>'Courses',
//        'single_name' =>'course',
//        'url_module_title'=>"courses",
//        'fontawesome_icon_class'=>"fa-bars",
//        'sub_modules'=>"",
//        'mod_do'=>array(
//            "0"=>array('can_do'=>"dash",'can_do_label'=>"dashboard -  احصائيات"),
//            "1"=>array('can_do'=>"edit",'can_do_label'=>"Edit - تعديل  "),
//            "2"=>array('can_do'=>"delete",'can_do_label'=>"Delete - حذف "),
//            "3"=>array('can_do'=>"print",'can_do_label'=>"Print - طباعه "),
//            "4"=>array('can_do'=>"eval",'can_do_label'=>"Evaluation 1- تقييم اولي  "),
//            "5"=>array('can_do'=>"eval2",'can_do_label'=>"Evaluation 2 - تقييم نهائي  "),
//            "6"=>array('can_do'=>"attend",'can_do_label'=>"Attendance rpt - سجل الحضور   "),
//            "7"=>array('can_do'=>"active",'can_do_label'=>"Activation - تفعيل  "),
//            "8"=>array('can_do'=>"trans",'can_do_label'=>"Tarnsfer - تحويل دورة  "),
//            "9"=>array('can_do'=>"add_time",'can_do_label'=>"Add time - اضافة مواعيد "),
//            "10"=>array('can_do'=>"del_time",'can_do_label'=>"Del time  - حذف مواعيد "),
//            "11"=>array('can_do'=>"appr1",'can_do_label'=>"St affairs approve - موافقة شؤون الطلاب حالات خاصة"),
//            "12"=>array('can_do'=>"appr2",'can_do_label'=>"Manager assist. approve  - موافقة مساعد المدير حالات خاصة "),
//            "13"=>array('can_do'=>"appr3",'can_do_label'=>"Finance approve - موافقة المالية حالات خاصة  "),
//            "14"=>array('can_do'=>"appr4",'can_do_label'=>" Manager Approve -  موافقة المدير حالات خاصة"),
//            "15"=>array('can_do'=>"trans_appr",'can_do_label'=>" Manager assist. approve (trans) - موافقة مساعد المدير علي التحويل "),
//            "16"=>array('can_do'=>"trans_appr2",'can_do_label'=>" Manager approve (trans)- موافقة المدير علي التحويل "),
//            "17"=>array('can_do'=>"schad",'can_do_label'=>"Courses Schadule -جدول الدورات "),
//            "18"=>array('can_do'=>"add_attend",'can_do_label'=>"Add attendance -تسجيل الحضور   "),
//            "19"=>array('can_do'=>"view_spec",'can_do_label'=>"view special cases - عرض الحالات الخاصة  "),
//            "20"=>array('can_do'=>"inv",'can_do_label'=>"Invoice - فاتورة "),
//            "21"=>array('can_do'=>"rec",'can_do_label'=>"Receipt - ايصال "),
//            "22"=>array('can_do'=>"groups",'can_do_label'=>"Groups - مجموعات الدورات "),
//            "23"=>array('can_do'=>"confirm_pay",'can_do_label'=>"confirm payment - تأكيد الدفع في الفاتوره  "),
//            "24"=>array('can_do'=>"cancel_lectures",'can_do_label'=>"Cancel lectures - الغاء محاضرات "),
//            "25"=>array('can_do'=>"tracking",'can_do_label'=>"Course Tracking - متابعة الدورات  "),
//            "26"=>array('can_do'=>"add_group",'can_do_label'=>"Add Group -  اضافة جروب  "),
//            "27"=>array('can_do'=>"edit_group",'can_do_label'=>"Edit Group - تعديل جروب   "),
//            "28"=>array('can_do'=>"delete_group",'can_do_label'=>"Delete Group -  حذف جروب  "),
//            "29"=>array('can_do'=>"invoice_no",'can_do_label'=>"Invoice No. -  رقم الفاتورة   "),
//            "30"=>array('can_do'=>"eval_appr",'can_do_label'=>"Evaluation approve  -  الموافقة علي التقييم    "),
//
//        )
//    ),
//    "1"=>array(
//        'name' =>'Teachers',
//        'single_name' =>'Teacher',
//        'url_module_title'=>"teachers",
//        'fontawesome_icon_class'=>"fa-bars",
//        'sub_modules'=>"",
//        'mod_do'=>array(
//            "0"=>array('can_do'=>"add",'can_do_label'=>"Add - اضافة"),
//            "1"=>array('can_do'=>"edit",'can_do_label'=>" Edit - تعديل  "),
//            "2"=>array('can_do'=>"delete",'can_do_label'=>" Delete - حذف "),
//            "3"=>array('can_do'=>"print",'can_do_label'=>"Print - طباعه "),
//
//        )
//    ), 		);

use App\Models\RoleModule;


function getModules()
{
    $modules = array(
        "0" => array(
            'name' => 'Events',
            'code' => 'events', // i put it
            'single_name' => 'Event',
            'url_module_title' => "events",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة"  ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "print", 'can_do_label' => "Print - طباعه " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'Print'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation' ),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
                "7" => array('can_do' => "show_print", 'can_do_label' => "Print Show Item - طباعه عرض العنصر "   , "can_do_label_ar" => 'طباعه عرض العنصر'  , "can_do_label_en" => 'Print Show Item'),
//                "8" => array('can_do' => "view", 'can_do_label' => "view - قائمة"),

            )
        ),
        "1" => array(
            'name' => 'Event Places',
            'code' => 'event_places',//i put it

            'single_name' => 'Event Place',

            'url_module_title' => "event_places",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" , "can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  "  , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف " , "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "print", 'can_do_label' => "Print - طباعه " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'Print'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات" , "can_do_label_ar" => 'احائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض" , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
                "7" => array('can_do' => "show_print", 'can_do_label' => "Print Show Item - طباعه عرض العنصر " , "can_do_label_ar" => 'طباعة عرض عنصر'  , "can_do_label_en" => 'Print Item'),

            )
        ),
        "2" => array(
            'name' => 'Event Types',
            'code' => 'event_types',//i put it

            'single_name' => 'Event Type',

            'url_module_title' => "event_types",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة"  ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "print", 'can_do_label' => "Print - طباعه " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'Print'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
                "7" => array('can_do' => "show_print", 'can_do_label' => "Print Show Item - طباعه عرض العنصر "   , "can_do_label_ar" => 'طباعه عرض العنصر'  , "can_do_label_en" => 'Print Show Item'),
//                '8' => array('can_do' => 'active' , 'can_do_label' => 'Active - الحالة' ) //here

            )
        ),


        "3" => array(
            'name' => 'Sliders',
            'code' => 'sliders',//i put it

            'single_name' => 'Slider',

            'url_module_title' => "sliders",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "3" => array('can_do' => "print", 'can_do_label' => "Print - طباعه " , "can_do_label_ar" => 'طباعة'  , "can_do_label_en" => 'Print'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
                "7" => array('can_do' => "show_print", 'can_do_label' => "Print Show Item - طباعه عرض العنصر "   , "can_do_label_ar" => 'طباعه عرض العنصر'  , "can_do_label_en" => 'Print Show Item'),

            )
        ),


        "4" => array(
            'name' => 'Pages',
            'code' => 'pages',//i put it
            'single_name' => 'Page',
            'url_module_title' => "pages",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),

        "5" => array(
            'name' => 'Settings',
            'code' => 'settings',//i put it
            'single_name' => 'Setting',
            'url_module_title' => "settings",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),
        "6" => array(
            'name' => 'Visitors',
            'code' => 'visitors',//i put it
            'single_name' => 'Visitors',
            'url_module_title' => "visitors",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),
        "7" => array(
            'name' => 'Reports',
            'code' => 'reports',//i put it
            'single_name' => 'Reports',
            'url_module_title' => "reports",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),

        "8" => array(
            'name' => 'Admins',
            'code' => 'admins',//i put it
            'single_name' => 'Admin',
            'url_module_title' => "admins",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),

        //here
        "9" => array(
            'name' => 'Roles',
            'code' => 'roles',//i put it
            'single_name' => 'Role',
            'url_module_title' => "roles",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  " , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),


        "10" => array(
            'name' => 'Pages',
            'code' => 'pages',//i put it
            'single_name' => 'Page',
            'url_module_title' => "pages",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),
        "11" => array(
            'name' => 'Permissions',
            'code' => 'permissions',//i put it
            'single_name' => 'Permission',
            'url_module_title' => "permission",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
            )
        ),
        "12" => array(
            'name' => 'Reports',
            'code' => 'reports',//i put it
            'single_name' => 'Report',
            'url_module_title' => "report",
            'fontawesome_icon_class' => "fa-bars",
            'sub_modules' => "",
            'mod_do' => array(
                "0" => array('can_do' => "add", 'can_do_label' => "Add - اضافة" ,"can_do_label_ar" => 'اضافة'  , "can_do_label_en" => 'Add'),
                "1" => array('can_do' => "edit", 'can_do_label' => " Edit - تعديل  " , "can_do_label_ar" => 'تعديل'  , "can_do_label_en" => 'Edit'),
                "2" => array('can_do' => "delete", 'can_do_label' => " Delete - حذف ", "can_do_label_ar" => 'الغاء'  , "can_do_label_en" => 'Delete'),
                "4" => array('can_do' => "active", 'can_do_label' => "Activation - تفعيل  "  , "can_do_label_ar" => 'تفعيل'  , "can_do_label_en" => 'Activation'),
                "5" => array('can_do' => "dash", 'can_do_label' => "dashboard -  احصائيات"  , "can_do_label_ar" => 'احصائيات'  , "can_do_label_en" => 'Dashboard'),
                "6" => array('can_do' => "show", 'can_do_label' => "show -  عرض"  , "can_do_label_ar" => 'عرض'  , "can_do_label_en" => 'Show'),
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

        "14" => array(
            'name' => 'contact_us',
            'code' => 'contact_us',//i put it
            'single_name' => 'Contact_us',
            'url_module_title' => "contact_us",
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


