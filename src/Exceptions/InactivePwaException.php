<?php

namespace Zmrq\PWA\Exceptions;

class InactivePwaException extends \Exception
{
    private const DEFAULT_MESSAGE = "The PWA is not active. Please enable it before proceeding.";
    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}
