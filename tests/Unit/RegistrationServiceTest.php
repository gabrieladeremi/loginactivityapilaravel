<?php

namespace Tests;

use App\Exceptions\RegistrationFailedException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\RegistrationService;

class RegistrationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testReturnsUserWhenSuccessfullyRegistered()
    {
        $this->setupDatabase();

        User::factory()->create();

        self::assertNotNull(RegistrationService::registerUser(
            'titus',
            'philemon',
            '123456789',
            'testing@gmail',
            'opic lagos',
            'testing@gmail'
        )
        );

    }

//    public function testThrowsExceptionIfUserRegistrationFails()
//    {
//        $this->setupDatabase();
//
//        $user = User::factory()->create();
//
//        $this->expectException(RegistrationFailedException::class);
//
//        $this->expectExceptionMessage('Fail to register user');
//    }

}
