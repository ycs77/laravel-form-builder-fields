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
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function validationMessages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function validationAttributes()
    {
        return [];
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
     * @param  string $fileUrl
     * @return \Illuminate\Http\Response
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeImage(Request $request)
    {
        $request->validate(
            $this->validationRules(),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $filePath = $request->file('upload_file')->store($this->storagePath);
        $fileUrl = Storage::url($filePath);

        return $this->response($fileUrl);
    }
}
