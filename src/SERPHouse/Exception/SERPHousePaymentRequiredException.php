<?php

namespace SERPHouse\Exception;

class SERPHousePaymentRequiredException extends SERPHouseSDKException
{
    public function __construct(string $message = 'Your SERPHouse account has either run out of available credits (try upgrading your Plan), or there is a payment problem.', int $code = 402, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
