<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('passport:install');
        $headers = [
            'Accept' =>'application/json',
        ];
    }

}
