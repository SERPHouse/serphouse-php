<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class Languages
{
    protected $method = 'GET';

    protected $apiEndPoint = 'language/list/{$type}';

    protected $httpClient = null;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function list($params = [])
    {
        $this->apiEndPoint = str_replace('{$type}', $params['type'] ?? 'google', $this->apiEndPoint);

        return $this->httpClient->sendRequest($this->method, $this->apiEndPoint);
    }
}
