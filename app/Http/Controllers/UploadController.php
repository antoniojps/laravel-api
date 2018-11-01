<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class UploadController extends Controller
{
    /**
     * Upload picture
     *
     * Very basic picture upload
     *
     * Image gets replaced always, and is accessible at 'storage/uploadedPic.png'
     * Png only (Client side verification)
     *
     * @bodyParam picture multipart/form-data
    */
    public function postUpload(Request $request)
    {
       $file = $request->file('picture');
       Storage::disk('public')->put('uploadedPic.png', File::get($file));

       return redirect('/');
    }
}
