<?php

namespace Ycs77\LaravelFormBuilderFields;

class RichEditorUpload
{
    /**
     * Require upload routes.
     *
     * @return void
     */
    public function routes()
    {
        require __DIR__ . '/../routes/web.php';
    }
}
