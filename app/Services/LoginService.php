<?php

namespace App\Services;

use App\Exceptions\LoginException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoginService
{
    public static function loginUser(Array $input): array
    {

        $retrieveSavedUser = User::where('email', $input['email'])->first();

        if( !$retrieveSavedUser ){

            throw LoginException::noUserFoundException('No user found with the credential');
        }

        if(! Auth()->attempt($input))
        {
            return response(['message' => 'invalid credentials'], 403);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        DB::table('login_records')->insert([
            'user_id' => auth()->user()->id,
            'created_at' => date("Y-m-d H:i:s"),
            'last_seen' => Carbon::now()
        ]);

        return [
            'user' => auth()->user(),
            'access token' => $accessToken
        ];

    }
}
