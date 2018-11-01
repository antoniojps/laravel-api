<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class UploadController extends Controller
{
    public function postUpload(Request $request)
    {
       $file = $request->file('picture');
       Storage::disk('public')->put('uploadedPic.png', File::get($file));

       return redirect('/');
    }
}
