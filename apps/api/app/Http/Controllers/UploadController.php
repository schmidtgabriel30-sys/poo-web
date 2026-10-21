<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    /**
     * @requestMediaType multipart/form-data
     */
    public function upload(UploadRequest $request)
    {
        // Salva o ficheiro na pasta de uploads
        $path = $request->file('file')->store('uploads');

        return [
            'path' => $path
        ];
    }
}