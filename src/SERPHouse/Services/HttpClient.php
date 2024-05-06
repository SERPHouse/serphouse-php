<?php

namespace SERPHouse\Services;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\BadResponseException;
use SERPHouse\Exception\SERPHouseNotFoundException;
use SERPHouse\Exception\SERPHousePaymentRequiredException;
use SERPHouse\Exception\SERPHouseRateLimitExceededException;
use SERPHouse\Exception\SERPHouseSDKException;
use SERPHouse\Exception\SERPHouseServerErrorException;
use SERPHouse\Exception\SERPHouseUnauthorizedException;
use SERPHouse\SERPHouseClient;
use SERPHouse\Services\Contracts\HttpContract;
use SERPHouse\Services\Handlers\Responses;

class HttpClient implements HttpContract
{
    /*
     * init new variable impemented Guzzle/
     */
    private $client;

    /**
     * Create a new HttpClient instance
     * This Class is using Guzzle/Http.
     *
     * HttpClient constructor.
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri'  => SERPHouseClient::getBaseUrl(),
            'headers'   => [
                'Authorization' => 'Bearer '.SERPHouseClient::getKey(),
                'Accept' => 'application/json',
            ],
        ]);
    }

    /*
     * @param string $method
     * @param string $url
     * @param array  $params
     *
     * @return \Handlers\Responses
     */
    public function sendRequest($method, $url, $params = []): Responses
    {
        $result = null;
        $content = null;

        try {
            $send = $this->client->request($method, $url, $params);
            $content = $send->getBody()->getContents();
            $result = new Responses($send->getStatusCode(), null, $content);
        } catch (BadResponseException $e) {
            $statusCode = $e->getCode();
            switch ($statusCode) {
                case 200:
                    break;
                case 400:
                    $result = new Responses($statusCode, $e->getMessage(), $e->getResponse()->getBody()->getContents());
                    break;
                case 401:
                    throw new SERPHouseUnauthorizedException();
                case 402:
                    throw new SERPHousePaymentRequiredException();
                case 404:
                    throw new SERPHouseNotFoundException();
                case 429:
                    throw new SERPHouseRateLimitExceededException();
                case 500:
                    throw new SERPHouseServerErrorException();
                default:
                    throw new SERPHouseSDKException('API error: HTTP '.$statusCode, $statusCode);
            }
        }
        unset($content);

        return $result;
    }
}
