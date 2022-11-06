<?php

namespace Wuwx\LaravelPlusView\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Wuwx\LaravelPlusView\LaravelPlusViewServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelPlusViewServiceProvider::class,
        ];
    }

    protected function defineRoutes($router)
    {
        $router->get("/", function () {
            return view("index");
        });
    }

    protected function getBasePath()
    {
        return __DIR__.'/../skeleton';
    }
}