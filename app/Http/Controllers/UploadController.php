<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function tempUpload(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
            }

            $field = $request->input('field');
            $file = $request->file('file');

            // Ensure temp folder exists
            $tempFolder = public_path('storage/temp');
            if (!file_exists($tempFolder)) {
                mkdir($tempFolder, 0755, true);
            }

            // Generate random name
            $newfile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($tempFolder, $newfile);

            // Relative path (for DB/session)
            $relativePath = 'temp/' . $newfile;

            // Store in session
            $tempFiles = session('temp_files', []);
            $tempFiles[$field] = $relativePath;
            session(['temp_files' => $tempFiles]);

            // ✅ Always return pure JSON (no views, no HTML)
            return response()->json([
                'success' => true,
                'path' => asset('storage/' . $relativePath), // preview URL
                'relative' => $relativePath, // for debugging
            ]);
        } catch (\Throwable $e) {
            Log::error('Upload error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Upload failed.'], 500);
        }
    }
}