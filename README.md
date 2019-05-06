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

Suggestions can be matched with [Laravel form builder BS4](https://github.com/ycs77/laravel-form-builder-bs4).

## Usage

This packages has types:

* [CheckableGroupType](#use-checkable-group-type)

## Use checkable group type

> The checkable group type is similar to the choice type, but it is difrence.

```bash
php artisan vendor:publish --tag=laravel-form-checkable-group-type
# or horizontal
php artisan vendor:publish --tag=laravel-form-checkable-group-type-horizontal
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


[ico-version]: https://img.shields.io/packagist/v/ycs77/laravel-form-builder-fields.svg?style=flat
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat
[ico-circleci]: https://img.shields.io/circleci/project/github/ycs77/laravel-form-builder-fields/master.svg?style=flat
[ico-downloads]: https://img.shields.io/packagist/dt/ycs77/laravel-form-builder-fields.svg?style=flat

[link-packagist]: https://packagist.org/packages/ycs77/laravel-form-builder-fields
[link-circleci]: https://circleci.com/gh/ycs77/laravel-form-builder-fields
[link-downloads]: https://packagist.org/packages/ycs77/laravel-form-builder-fields
