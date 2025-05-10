<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $filePath = $request->file('file')->storeAs('uploads', $request->file('file')->getClientOriginalName(), 'public');
        $fileUrl = "/uploads/" . $request->file('file')->getClientOriginalName();

        return response()->json([
            'success' => true,
            'file_url' => $fileUrl,
        ]);
    }
}
