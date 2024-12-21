<?php

namespace Balajidharma\LaravelAttributes\Exceptions;

use Exception;

class AttributeValueException extends Exception
{
    public static function invalidValue($message)
    {
        return new static($message);
    }
}