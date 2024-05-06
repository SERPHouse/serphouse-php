<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class Domains
{
    protected $method = 'GET';

    protected $apiEndPoint = 'domain/list';

    protected $httpClient = null;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function list()
    {
        return $this->httpClient->sendRequest($this->method, $this->apiEndPoint);
    }
}
