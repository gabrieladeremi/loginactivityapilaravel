<?php

namespace App\Exceptions;

class LoginException extends \RuntimeException
{
    public static function noUserFoundException(string $message)
    {
        return new static($message, 401);
    }

}
