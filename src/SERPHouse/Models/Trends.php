<?php

namespace SERPHouse\Models;

use SERPHouse\Services\HttpClient;

class Trends
{
    protected $apiEndPoint = 'trends';

    protected $httpClient = null;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    public function search($params = [])
    {
        return $this->httpClient->sendRequest('POST', $this->apiEndPoint.'/search', ['json' => $params]);
    }

    public function schedule($params = [])
    {
        return $this->httpClient->sendRequest('POST', $this->apiEndPoint.'/schedule', ['json' => $params]);
    }

    public function timeZoneList()
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/offset/list');
    }

    public function categoryList()
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/categories/list');
    }

    public function countryStateList()
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/country/list');
    }

    public function languageList()
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/language/list');
    }

    public function get($id = null)
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/get', [
            'query' => [
                'id' => $id,
            ],
        ]);
    }

    public function check($id = null)
    {
        return $this->httpClient->sendRequest('GET', $this->apiEndPoint.'/check', [
            'query' => [
                'id' => $id,
            ],
        ]);
    }
}
