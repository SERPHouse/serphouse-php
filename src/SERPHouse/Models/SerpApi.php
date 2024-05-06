<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class SerpApi
{
    protected $apiEndPoint = 'serp';

    protected $httpClient = null;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function live($params = [], $responseType = 'json')
    {
        return $this->httpClient->sendRequest('POST', $this->apiEndPoint.'/live/'.($responseType ?? 'json'), ['json' => $params]);
    }

    public function schedule($params = [])
    {
        return $this->httpClient->sendRequest('POST', $this->apiEndPoint.'/schedule', ['json' => $params]);
    }

    public function check($id = null)
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/check', [
            'query' => [
                'id' => $id,
            ],
        ]);
    }

    public function get($id = null, $responseType = 'json')
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/get/'.($responseType ?? 'json'), [
            'query' => [
                'id' => $id,
            ],
        ]);
    }
}
