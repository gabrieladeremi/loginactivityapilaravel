<?php

namespace App\Services;

use App\Events\NewUserRegisteredEvent;
use App\Exceptions\RegistrationFailedException;
use App\Exceptions\UserExistException;
use App\Models\User;
use App\Support\RegistrationResponse;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public static function registerUser(
        string $firstname,
        string $lastname,
        string $phoneNumber,
        string $email,
        string $address,
        string $password
    ): RegistrationResponse {

        if (User::where('email', $email)->count() > 0 ) {

            throw UserExistException::userExistException('An account exist with this email');
        }

        $user = User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'address' => $address,
            'password' => Hash::make($password),
        ]);

        if ($user === null) {

            throw RegistrationFailedException::failToRegister('Fail to register user');

        }

        event(new NewUserRegisteredEvent($user));

        return new RegistrationResponse($user);
    }

}
