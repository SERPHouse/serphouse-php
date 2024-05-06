<?php

namespace SERPHouse\Services\Handlers;

class Responses
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var null|string
     */
    private $response;

    private $errorMessage;

    public function __construct($status, $errorMessage = null, $response = null)
    {
        $this->statusCode = $status;
        $this->errorMessage = $errorMessage;
        $this->response = $response;
    }

    /*
     * getters for response
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /*
     * getters for message
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
