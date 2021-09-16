<?php

namespace Tests\Unit;

use App\Models\LoginRecords;
use App\Services\LoginRecordsService;
use Tests\TestCase;

class LoginRecordsServiceTest extends TestCase
{
    public function testToAssertNotNullWhenRetrievingUserLoginRecords()
    {
        $this->setupDatabase();

        $res = LoginRecords::factory()->create();

        $response = LoginRecordsService::fetchUserLoginRecords($res['user_id']);

        $this->assertNotNull($response);

    }

}
