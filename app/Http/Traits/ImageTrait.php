<?php

namespace App\Http\Traits;


trait ImageTrait
{

    function storeImage($request, $path, $requestName, $name, $key = 0)
    {

        if ($request->hasfile($name)) {
            $file = $requestName;
            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . $path, $newfile);
            return $path . '/' . $newfile;
        }
    }


    function deleteImage($model, $name)
    {
        if ($model->$name && !(is_dir(public_path() . ($model->$name))) && file_exists(public_path() . ($model->$name))) {
            unlink(public_path() . ($model->$name));
        }
//        unlink(public_path() . ($model->$name));

//        dd($model , $name);
    }


    function updateImage($request, $path, $requestName, $name, $model, $key = 0)
    {
        if (!(is_dir(public_path() . ($model->$name))) && file_exists(public_path() . ($model->$name))) {
            unlink(public_path() . ($model->$name));
        }
        if ($request->hasfile($name)) {
            $file = $requestName;
            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . $path, $newfile);
            return $path . '/' . $newfile;
        }
    }


    function deleteMultipleImages($array , $name)
    {
        if( $array && count($array)  )
        foreach ($array as $photo) {
            if (!(is_dir(public_path() . ($photo ))) && file_exists(public_path() . ($photo ))) {
                unlink(public_path() . ($photo ));
            }
        }
    }



    function storeImageMulti($request , $path , $requestName , $name)
    {
        $newfileAll = [];
        foreach ($requestName as $key => $val) {

            if(isset($requestName[$key])) {
                if (isset($request->file($name)[$key])) {
                    $file = $request->file($name)[$key];
                    $newfile = time().$key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . $path, $newfile);
                    $newfileAll[] = $path . $newfile;
                }
            }
        }
        return $newfileAll;
    }

}
