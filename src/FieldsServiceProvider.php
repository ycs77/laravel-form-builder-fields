<?php

namespace Ycs77\LaravelFormBuilderFields;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class FieldsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-form-builder');

        $fields_name = [
            'checkable_group',
        ];

        foreach ($fields_name as $field_name) {
            $field_name_kebab = Str::kebab(Str::camel($field_name));

            $this->publishes([
                __DIR__ . "/../resources/views/$field_name.php" => resource_path("views/vendor/laravel-form-builder/$field_name.php"),
            ], "laravel-form-$field_name_kebab-type");

            $this->publishes([
                __DIR__ . "/../resources/views-horizontal/$field_name.php" => resource_path("views/vendor/laravel-form-builder/$field_name.php"),
            ], "laravel-form-$field_name_kebab-type-horizontal");
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
