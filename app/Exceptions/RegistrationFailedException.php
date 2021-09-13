<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\Pure;

class RegistrationFailedException extends \RuntimeException
{

    #[Pure] public static function failToRegister(string $message): static
    {
        return new static($message, 500);
    }
}
