<?php

namespace WebduoNederland\LaravelImageResizer\Tests;

use WebduoNederland\LaravelImageResizer\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
