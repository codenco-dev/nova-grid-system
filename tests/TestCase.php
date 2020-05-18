<?php


namespace CodencoDev\NovaGridSystem\Tests;


use CodencoDev\NovaGridSystem\ToolServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ToolServiceProvider::class
        ];
    }
}