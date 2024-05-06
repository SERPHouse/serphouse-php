<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class LanguagesTest extends TestCase
{
    public function testListLanguages()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->languages->List();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }
}
