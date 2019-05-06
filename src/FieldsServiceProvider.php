<?php

namespace Ycs77\LaravelFormBuilderFields;

use Illuminate\Support\ServiceProvider;

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

        $this->registerPublishes();
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

    /**
     * Register resources publishes group.
     *
     * @return void
     */
    public function registerPublishes()
    {
        if ($this->app->runningInConsole()) {
            $this->publishFieldResource('checkable_group');
            $this->publishFieldResource('checkable_group', [], true);
            $this->publishFieldResource('rich_editor', [
                __DIR__ . '/../public' => public_path('vendor/laravel-form-builder-fields'),
            ]);
        }
    }

    /**
     * Publish field resource.
     *
     * @return void
     */
    protected function publishFieldResource($name, $mergePaths = [], $isHorizontal = false)
    {
        $kebabName = str_replace('_', '-', $name);
        $input_path = __DIR__ . "/../resources/views/$name.php";
        $output_path = resource_path("views/vendor/laravel-form-builder/$name.php");
        $tag = "laravel-form-builder-$kebabName-type";

        if ($isHorizontal) {
            $input_path =  __DIR__ . "/../resources/views-horizontal/$name.php";
            $tag = "laravel-form-builder-$kebabName-type-horizontal";
        }

        if (file_exists($input_path)) {
            $this->publishes(array_merge(
                [$input_path => $output_path],
                $mergePaths
            ), $tag);
        }
    }
}
