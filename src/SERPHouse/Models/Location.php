<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class Location
{
    protected $method = 'GET';

    protected $apiEndPoint = 'location/search?q={$q}&type={$type}';

    protected $httpClient = null;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function search($params = [])
    {
        $this->apiEndPoint = str_replace('{$q}', $params['q'] ?? '', $this->apiEndPoint);
        $this->apiEndPoint = str_replace('{$type}', $params['type'] ?? '', $this->apiEndPoint);

        return $this->httpClient->sendRequest($this->method, $this->apiEndPoint);
    }
}
