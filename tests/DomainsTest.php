<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class DomainsTest extends TestCase
{
    public function testListDomains()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $response = $api->domains->List();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }
}
