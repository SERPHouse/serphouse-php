<?php

namespace SERPHouse\Exception;

class SERPHouseNotFoundException extends SERPHouseSDKException
{
    public function __construct(string $message = 'Not Found: Resource not found', int $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
