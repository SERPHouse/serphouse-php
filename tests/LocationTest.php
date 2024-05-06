<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class LocationTest extends TestCase
{
    public function testSearchLocation()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->location->search(['q' => 'Test', 'type' => 'google']);
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }
}
