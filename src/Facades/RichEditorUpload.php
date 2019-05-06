<?php

namespace Ycs77\LaravelFormBuilderFields\Facades;

use Illuminate\Support\Facades\Facade;
use Ycs77\LaravelFormBuilderFields\RichEditorUpload as BaseRichEditorUpload;

/**
 * @method static void routes()
 *
 * @see \Ycs77\LaravelFormBuilderFields\RichEditorUpload
 */
class RichEditorUpload extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new BaseRichEditorUpload;
    }
}
