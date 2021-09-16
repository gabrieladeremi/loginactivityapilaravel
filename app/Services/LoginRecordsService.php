<?php

namespace App\Services;

use http\Exception\RuntimeException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginRecordsService
{
    public static function fetchUserLoginRecords(String $currentUserId)
    {
        $userLoginRecords = (array) DB::table('login_records')
                            ->where('user_id', $currentUserId)
                            ->get();

        if ($userLoginRecords === null ) {

            throw new RuntimeException('No record found');
        }

        foreach ($userLoginRecords as $records){

                 return $records;
        }


    }
}
