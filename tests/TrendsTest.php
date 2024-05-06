<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class TrendsTest extends TestCase
{
    public function testSearchTrends()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        $response = $api->trends->search([
            'time_zone_offset' => '-330',
            'keywords' => 'google,youtube',
            'time' => 'now 1-d',
            'property' => 'youtube',
            'category' => '0',
            'geo' => 'us',
            'language_code' => 'en',
        ]);
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);

        putenv('TRENDS_ID='.json_decode($response->getResponse())->search_metadata->id);
    }

    public function testSearchTrendsWithValidationErrors()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        /**
         * time_zone_offset field is required but not passed.
         */
        $response = $api->trends->search([
            'keywords' => 'google,youtube',
            'time' => 'now 1-d',
            'property' => 'youtube',
            'category' => '0',
            'geo' => 'us',
            'language_code' => 'en',
        ]);
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testScheduleTrends()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $params = [
            'data' => [
                [
                    'time_zone_offset' => -330,
                    'keywords' => 'google',
                    'time' => 'now 1-d',
                    'property' => 'youtube',
                    'category' => 0,
                    'geo' => 'us',
                    'language_code' => 'en',
                ],
            ],
        ];
        $response = $api->trends->schedule($params);
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
        $this->assertIsNumeric(json_decode($response->getResponse())->results[0]->id);
    }

    public function testScheduleTrendsWithValidationErrors()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        /**
         * time_zone_offset field is required but not passed.
         */
        $params = [
            'data' => [
                [
                    'keywords' => 'google',
                    'time' => 'now 1-d',
                    'property' => 'youtube',
                    'category' => 0,
                    'geo' => 'us',
                    'language_code' => 'en',
                ],
            ],
        ];
        $response = $api->trends->schedule($params);
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testGetTrendsTimeZoneList()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->timeZoneList();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetTrendsCategoryList()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->categoryList();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetTrendsCountryStateList()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->countryStateList();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetTrendsLanguageList()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->languageList();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testCheckTrends()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->check(getenv('TRENDS_ID'));
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testCheckTrendsWithoutPassID()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->check();
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }

    public function testGetTrends()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->get(getenv('TRENDS_ID'));
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testGetTrendsWithoutPassID()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->trends->get();
        $this->assertIsObject($response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('error', json_decode($response->getResponse())->status);
        $this->assertEquals('validation_error', json_decode($response->getResponse())->msg);
    }
}
