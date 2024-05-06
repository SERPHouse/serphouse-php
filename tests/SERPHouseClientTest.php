<?php

namespace SERPHouse\Tests;

use PHPUnit\Framework\TestCase;
use SERPHouse\SERPHouseClient;

class SERPHouseClientTest extends TestCase
{
    private $url = 'https://api.serphouse.com';

    public function testGetkey()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $data = $api->getKey();

        $this->assertTrue(strlen($data) > 0);
        $this->assertTrue($data === getenv('API_KEY'));
    }

    public function testGetBaseUrl()
    {
        $api = new SERPHouseClient(getenv('API_KEY'));
        $data = $api->getBaseUrl();
        $this->assertTrue($this->url == $data);
    }
}
