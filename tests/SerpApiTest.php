<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class SerpApiTest extends TestCase
{
    public function testLiveSerp()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        $response = $api->serpApi->live([
            'data' => [
                'q' => 'apple',
                'domain' => 'google.com',
                'lang' => 'en',
                'device' => 'desktop',
                'serp_type' => 'web',
                'loc' => 'Alba,Texas,United States',
                'loc_id' => '1026201',
                'verbatim' => '0',
                'gfilter' => '0',
                'page' => '1',
                'num_result' => '10',
            ],
        ]);

        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
        putenv('SERP_ID='.json_decode($response->getResponse())->results->search_metadata->id);
    }

    public function testLiveSerpWithValidationErrors()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        /**
         * q field is required but not passed.
         */
        $response = $api->serpApi->live([
            'data' => [
                'domain' => 'google.com',
                'lang' => 'en',
                'device' => 'desktop',
                'serp_type' => 'web',
                'loc' => 'Alba,Texas,United States',
                'loc_id' => '1026201',
                'verbatim' => '0',
                'gfilter' => '0',
                'page' => '1',
                'num_result' => '10',
            ],
        ]);
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testScheduleSerp()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        $params = [
            'data' => [
                [
                    'q' => 'Coffee',
                    'domain' => 'google.com',
                    'lang' => 'en',
                    'device' => 'desktop',
                    'serp_type' => 'web',
                    'loc' => 'Alba,Texas,United States',
                    'verbatim' => 0,
                    'page' => 1,
                    'num_result' => 10,
                ],
            ],
        ];

        $response = $api->serpApi->schedule($params);
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testScheduleSerpWithValidationErrors()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        /**
         * q field is required but not passed.
         */
        $params = [
            'data' => [
                [
                    'domain' => 'google.com',
                    'lang' => 'en',
                    'device' => 'desktop',
                    'serp_type' => 'web',
                    'loc' => 'Alba,Texas,United States',
                    'verbatim' => 0,
                    'page' => 1,
                    'num_result' => 10,
                ],
            ],
        ];

        $response = $api->serpApi->schedule($params);
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testGetSerp()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->get(getenv('SERP_ID'));
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetSerpWithHtmlResponse()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->get(getenv('SERP_ID'), 'html');
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertStringContainsString('<html', $response->getResponse());
        $this->assertStringContainsString('<body', $response->getResponse());
    }

    public function testGetSerpWithJSONResponse()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->get(getenv('SERP_ID'), 'json');
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertNotNull(json_decode($response->getResponse()), 'The response is not a valid JSON object');
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetSerpWithoutPassID()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->get();
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testCheckSerp()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->check(getenv('SERP_ID'));
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testCheckSerpWithoutPassID()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->serpApi->check();
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }
}
