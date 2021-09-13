<?php

namespace App\Services;

use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutService
{
    public static function userLogout(): string
    {
        $id = Auth::id();

        $user = Auth::user()->token();


        if($user->revoke()) {

            DB::table('login_records')
                ->update(['last_seen' => Carbon::now()])
                ->where('user_id', $id);

            return 'User Logged out';
        }

        return 'Something went wrong';

    }
}
