<?php

namespace Ycs77\LaravelFormBuilderFields\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class RichEditorType extends FormField
{
    /**
     * {@inheritdoc}
     */
    protected function getTemplate()
    {
        return 'rich_editor';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaults()
    {
        return [
            'upload_image' => false,
        ];
    }
}
