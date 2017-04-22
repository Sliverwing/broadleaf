<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// TODO: Add File Upload Permission
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $field = $request->input('field', 'image');
        $this->validate($request ,[
            $field => 'required|image',
        ]);
        $fileDist = $request->file($field)->store('public');
        return ['status' => 'success', 'link' => Storage::url($fileDist)];
    }
}
