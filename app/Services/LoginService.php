<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;

class LoginService
{
    public static function loginUser(Array $input): array
    {
        $retrieveSavedUser = User::where('email', $input['email'])->first();

        if (!$retrieveSavedUser) {

            throw new AuthenticationException('No account found with credential');
        }

        if (! Auth()->attempt($input)) {

            throw new AuthenticationException('No account found with credential');
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        DB::table('login_records')->insert([
            'user_id' => auth()->user()->id,
            'created_at' => date("Y-m-d H:i:s"),
            'last_seen' => Carbon::now()
        ]);

        return ['user' => auth()->user(), 'access_token' => $accessToken];
    }
}
