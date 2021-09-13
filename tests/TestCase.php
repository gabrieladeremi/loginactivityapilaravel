<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private bool $hasSetupDatabase = false;

    protected function setupDatabase(): self
    {
        if ($this->hasSetupDatabase) {

            return $this;

        }

        $this->artisan('migrate:fresh');

        $this->hasSetupDatabase = true;

        return $this;
    }
}
