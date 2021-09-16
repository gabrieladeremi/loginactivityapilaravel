<?php

namespace App\Support;

use App\Models\User;

class RegistrationResponse
{
    public function __construct(
        public User $user,
        public ?string $token = null
    ) {
        $this->token ??= $this->user->createToken('authToken')->accessToken;
    }
}
