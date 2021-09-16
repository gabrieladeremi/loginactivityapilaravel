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

        if (User::where('email', $email)->first()) {

            throw UserExistException::userExistException(
                'A user with this email already exist, '
            );
        }

        $instantiateUser = new User();
        $instantiateUser->firstname = $firstname;
        $instantiateUser->lastname = $lastname;
        $instantiateUser->email = $email;
        $instantiateUser->phoneNumber = $phoneNumber;
        $instantiateUser->address = $address;
        $instantiateUser->password = Hash::make($password);

        $wasUserCreated = $instantiateUser->save();

        if ($wasUserCreated === null) {

            throw RegistrationFailedException::failToRegister('Fail to register user');

        }

        $user = User::where('email', $email)->first();
        // Test to check if the user was fetched successfully
        if ($user === null) {

            throw new \RuntimeException('Issues retrieving user profile information');
        }

        event(new NewUserRegisteredEvent($user));

        return new RegistrationResponse($user);
    }

}
