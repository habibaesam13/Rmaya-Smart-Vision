<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\LogsTrait;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageTrait,LogsTrait;

    public function edit()
    {
        if (checkModulePermission('settings', 'view')) {

            $setting = SiteSettings::first();

            return view('admin.settings.edit', compact('setting'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

    public function update(Request $request)
    {
        if (checkModulePermission('settings', 'edit')) {

            $arr = $request->except('image', 'secondary_logo');
            //here
            if (is_array($request->image) && !empty(array_values($request->image)[0])) {
                foreach ($request->image as $key => $img) {
                    $oldImage = SiteSettings::select($key)->first();
                    if (isset($oldImage->$key) && !(is_dir(public_path() . ('/' . $oldImage->$key))) && file_exists(public_path() . ('/' . $oldImage->$key))) {
                        unlink(public_path() . ('/' . $oldImage->$key));
                    }

                    $file = $request->image[$key];
                    $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/settings/', $newfile);
                    $imgFile = 'settings' . '/' . $newfile;
                    $arr = array_merge($arr, [$key => $imgFile]);
                }
            }


            if ($request->hasFile('secondary_logo') && $request->file('secondary_logo')->isValid()) {
                // Get the file content and encode it to Base64
                $secondary_logo = base64_encode(file_get_contents($request->file('secondary_logo')->path()));
            }
            if(isset($secondary_logo)){
                $arr = array_merge($arr, ['secondary_logo' => $secondary_logo]);
            }


            if (SiteSettings::first()) {
                foreach ($arr as $name => $val) {
                    if (isset($arr[$name])) {
                        SiteSettings::first()->update([$name => $arr[$name]]);
                         $this->saveAction('الاعدادات',1,'تم تعديل اعدادات النظام' );
                    }
                }
            } else {
                if (!empty($arr)) {
                    SiteSettings::create($arr);
                }
            }


            return redirect()->back()->with('success', __('lang.Settings has been Updated Successfully'));
        }else {
            return redirect()->back()->with('error', __('lang.not permitted'));
        }
    }

}
