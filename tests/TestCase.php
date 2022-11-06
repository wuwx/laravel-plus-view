<?php

namespace Wuwx\LaravelPlusView\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Wuwx\LaravelPlusView\LaravelPlusViewServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app['router']->get("/", function () {
            return view("index");
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelPlusViewServiceProvider::class,
        ];
    }

    protected function getBasePath()
    {
        return __DIR__.'/../skeleton';
    }
}