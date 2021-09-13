<?php

namespace App\Services;

use App\Exceptions\RegistrationFailedException;
use App\Models\User;
use http\Exception\RuntimeException;

class RegistrationService
{
    public static function registerUser(
        string $firstname,
        string $lastname,
        string $phoneNumber,
        string $email,
        string $address,
        string $password

    ): User {

        $instantiateUser = new User();
        $instantiateUser->firstname = $firstname;
        $instantiateUser->lastname = $lastname;
        $instantiateUser->email = $email;
        $instantiateUser->phoneNumber = $phoneNumber;
        $instantiateUser->address = $address;
        $instantiateUser->password = $password;

        $wasUserCreated = $instantiateUser->save();

        // Need to write against this logic to know if a user was created or not
        // if not found throw an exception
        if ($wasUserCreated === null) {

            throw RegistrationFailedException::failToRegister('Fail to register user');

        }

        $user = User::where('email', $email)->first();
        // Test to check if the user was fetched successfully
        if ($user === null) {

            throw new RuntimeException('Issues retrieving user profile information');
        }

        return $user;
    }

}
