<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class Account
{
    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $apiEndPoint = 'account/info';

    /**
     * @var HttpClient
     */
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function fetch()
    {
        return $this->httpClient->sendRequest($this->method, $this->apiEndPoint);
    }
}
