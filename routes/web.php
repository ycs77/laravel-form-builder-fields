<?php

use Illuminate\Support\Facades\Route;

Route::post('/upload', '\\Ycs77\\LaravelFormBuilderFields\\Http\\Controllers\\UploadController@storeImage')->name('upload');
