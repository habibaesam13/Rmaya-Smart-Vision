<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function tempUpload(Request $request)
{
    if ($request->hasFile('file')) {
        $field = $request->input('field'); // e.g. members[0][front_id_pic]

        $file = $request->file('file');
        $path = $file->store('temp', 'public');

        // Store under the field name instead of just the filename
        $tempFiles = session('temp_files', []);
        $tempFiles[$field] = $path;
        session(['temp_files' => $tempFiles]);

        return response()->json([
            'success' => true,
            'path' => asset('storage/' . $path)
        ]);
    }

    return response()->json(['success' => false]);
}

}
