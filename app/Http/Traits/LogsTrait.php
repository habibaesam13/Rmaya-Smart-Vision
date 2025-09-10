<?php

namespace App\Http\Traits;


use App\Models\Logs;
use Carbon\Carbon;

trait LogsTrait
{

    function saveAction($module_name, $item_id, $action)
    {
//        if ($action === 'index' && (Logs::where(['action' => 'index', 'module_name' => $module_name, 'admin_id' => auth()->id()])->where('created_at', '>', (Carbon::parse(time() - 3600)))->count())) {
//
//            return;
//        }
        Logs::create(
            [
                'admin_id' => auth()->id(),
                'module_name' => $module_name,
                'item_id' => $item_id,
                'action' => $action,
            ]
        );

    }

}
