# Laravel form builder's fields

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-circleci]][link-circleci]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

[Laravel form builder](https://github.com/kristijanhusak/laravel-form-builder) must be installed.

Via Composer

```bash
composer require ycs77/laravel-form-builder-fields
```

## Types

* Checkable group type
* Rich editor type

## Checkable group type

> The checkable group type is similar to the choice type, but it is difrence.

```bash
php artisan vendor:publish --tag=laravel-form-builder-checkable-group-type
# or horizontal
php artisan vendor:publish --tag=laravel-form-builder-checkable-group-type-horizontal
```

Set config:

*config/laravel-form-builder.php*
```php
<?php

return [

    // Templates
    // ...
    'checkable_group' => 'laravel-form-builder::checkable_group',

    'custom_fields' => [
        'checkable_group' => '\Ycs77\LaravelFormBuilderFields\Fields\CheckableGroupType',
    ],
];

```

Use checkable group:

```php
$this->add('field_name', 'checkable_group', [
    'choices' => [
        'en' => 'English',
        'fr' => 'French',
    ],
    'is_checkbox' => true, // False is radio
    'selected' => ['en'],
    // 'choice_options' => [
    //     'wrapper' => [
    //         'class' => 'form-control',
    //     ],
    // ],
]);
```

### Style class config

Use bootstrap 4 class: 

*config/laravel-form-builder.php*
```php
<?php

return [
    'defaults' => [
        // ...

        'checkable_group' => [
            // 'wrapper_class' => 'form-group',
        ],

        'checkbox' => [
            // ...

            'choice_options' => [
                'wrapper_class' => 'custom-control custom-checkbox',
                'label_class' => 'custom-control-label',
                'field_class' => 'custom-control-input',
            ],
        ],

        'radio' => [
            // ...

            'choice_options' => [
                'wrapper_class' => 'custom-control custom-radio',
                'label_class' => 'custom-control-label',
                'field_class' => 'custom-control-input',
            ],
        ],
    ],
];

```

Or horizontal style:

*config/laravel-form-builder.php*
```php
<?php

return [
    'defaults' => [
        // ...

        'checkable_group' => [
            'label_class' => 'col-lg-2 col-form-label text-lg-right pt-0',
        ],

        // Same...
    ],
];

```

## Rich editor type

This rich editor default use [TinyMCE](https://www.tiny.cloud/), you can replace it.

```bash
php artisan vendor:publish --tag=laravel-form-builder-rich-editor-type
```

Set config:

*config/laravel-form-builder.php*
```php
<?php

return [

    // Templates
    // ...
    'rich_editor' => 'laravel-form-builder::rich_editor',

    'custom_fields' => [
        'rich_editor' => '\Ycs77\LaravelFormBuilderFields\Fields\RichEditorType',
    ],
];

```

Use rich editor:

```php
$this->add('content', 'rich_editor');
```

> Download the [TinyMCE Language Packages](https://www.tiny.cloud/get-tiny/language-packages/)

### Purify rich editor content

Install [HTMLPurifier for laravel](https://github.com/mewebstudio/Purifier) package:

```
composer require mews/purifier
```

Use to your controller:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $content = Purifier::clean($request->content);
    }
}

```

### Upload image

> Before you start, you must set `config('app.url')` and `config('filesystems.default')`.

The image default will be uploaded to `/upload`. Add upload routes to *routes/web.php*:

```php
<?php

use Ycs77\LaravelFormBuilderFields\Facades\RichEditorUpload;

// Other routes...

RichEditorUpload::routes();
```

Open upload image on rich editor:

```php
$this->add('content', 'rich_editor', [
    'upload_image' => true,
]);
```

Language settings:

*resources/lang/{Language}/validation.php*
```php
'custom' => [
    'upload_file' => [
        'required' => 'Upload file does not exist',
    ],
],

'attributes' => [
    'upload_file' => 'Upload file',
],
```

*resources/lang/{Language}.json*
```json
{
  "Upload error": "Upload error"
}
```

If you want to modify the upload feature, you can extends `Ycs77\LaravelFormBuilderFields\Http\Controllers\UploadController` to modified:

```php
<?php

namespace App\Http\Controllers;

use Ycs77\LaravelFormBuilderFields\Http\Controllers\UploadController as BaseUploadController;

class UploadController extends BaseUploadController
{
    // ...
}

```

[ico-version]: https://img.shields.io/packagist/v/ycs77/laravel-form-builder-fields.svg?style=flat
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat
[ico-circleci]: https://img.shields.io/circleci/project/github/ycs77/laravel-form-builder-fields/master.svg?style=flat
[ico-downloads]: https://img.shields.io/packagist/dt/ycs77/laravel-form-builder-fields.svg?style=flat

[link-packagist]: https://packagist.org/packages/ycs77/laravel-form-builder-fields
[link-circleci]: https://circleci.com/gh/ycs77/laravel-form-builder-fields
[link-downloads]: https://packagist.org/packages/ycs77/laravel-form-builder-fields
