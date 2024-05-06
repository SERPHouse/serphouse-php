<?php

namespace SERPHouse\Exception;

class SERPHouseRateLimitExceededException extends SERPHouseSDKException
{
    public function __construct(string $message = 'Rate Limit Exceeded: Too many requests', int $code = 429, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
