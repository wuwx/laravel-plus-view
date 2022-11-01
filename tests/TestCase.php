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
}