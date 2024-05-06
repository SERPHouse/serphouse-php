<?php

namespace SERPHouse\Exception;

class SERPHouseUnauthorizedException extends SERPHouseSDKException
{
    public function __construct(
        string $message = 'Unauthenticated: Access denied',
        int $code = 401,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
