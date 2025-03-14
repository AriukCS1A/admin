<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class VoyagerUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $upload = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'voyager_uploads',
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'link' => $upload->getSecurePath()
                ]
            ]);
        }

        return response()->json(['success' => false]);
    }
}
