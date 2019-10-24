<?php

namespace Ycs77\LaravelFormBuilderFields\Test;

use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderServiceProvider;
use Kris\LaravelFormBuilder\FormHelper;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Ycs77\LaravelFormBuilderFields\FieldsServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * @var \Illuminate\Translation\Translator
     */
    protected $translator;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Kris\LaravelFormBuilder\FormHelper
     */
    protected $formHelper;

    /**
     * @var \Kris\LaravelFormBuilder\FormBuilder
     */
    protected $formBuilder;

    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $eventDispatcher;

    /**
     * @var \Kris\LaravelFormBuilder\Form
     */
    protected $plainForm;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->view = $this->app['view'];
        $this->translator = $this->app['translator'];
        $this->request = $this->app['request'];
        $this->request->setLaravelSession($this->app['session.store']);
        $this->eventDispatcher = $this->app['events'];
        $this->config = include __DIR__ . '/config.php';

        $this->formHelper = new FormHelper($this->view, $this->translator, $this->config);
        $this->formBuilder = new FormBuilder($this->app, $this->formHelper, $this->eventDispatcher);

        $this->plainForm = $this->formBuilder->plain();
    }

    public function tearDown(): void
    {
        $this->view = null;
        $this->request = null;
        $this->config = null;
        $this->formHelper = null;
        $this->formBuilder = null;
        $this->plainForm = null;
    }

    protected function getPackageProviders($app)
    {
        return [
            FormBuilderServiceProvider::class,
            FieldsServiceProvider::class,
        ];
    }
}
