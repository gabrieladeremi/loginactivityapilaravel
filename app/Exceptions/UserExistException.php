<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\Pure;

class UserExistException extends \RuntimeException
{
    #[Pure] public static function userExistException(string $message): static
    {
        return new static($message, 409);
    }

}
