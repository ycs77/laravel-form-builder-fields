<?php

namespace Ycs77\LaravelFormBuilderFields\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Validation rules.
     *
     * @return array
     */
    public function validationRules()
    {
        return [
            'upload_file' => 'required|mimes:jpeg,png|max:5120',
        ];
    }

    /**
     * Storage path.
     *
     * @var string
     */
    public $storagePath = 'images';

    /**
     * Response data.
     *
     * @return array
     */
    public function response($fileUrl)
    {
        return response()->json([
            'location' => $fileUrl,
        ]);
    }

    /**
     * Store a upload images to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        $request->validate($this->validationRules());

        $filePath = $request->file('upload_file')->store($this->storagePath);
        $fileUrl = Storage::url($filePath);

        return $this->response($fileUrl);
    }
}
