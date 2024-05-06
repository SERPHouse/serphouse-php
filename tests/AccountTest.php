<?php

use PHPUnit\Framework\TestCase;
use SERPHouse\Exception\SERPHouseUnauthorizedException;
use SERPHouse\SERPHouseClient;

class AccountTest extends TestCase
{
    public function testFetchAccount()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));

        $response = $api->account->fetch();
        $this->assertIsObject($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getResponse());
        $this->assertEquals('success', json_decode($response->getResponse())->status);
    }

    public function testSearchTrendsWithIncorrectKey()
    {
        $this->expectException(SERPHouseUnauthorizedException::class);

        $api = new SERPHouseClient(getenv('API_KEY').'1112222221111');

        $api->account->fetch();
    }
}
