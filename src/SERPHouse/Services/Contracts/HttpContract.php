<?php

namespace SERPHouse\Services\Contracts;

interface HttpContract
{
    /*
     *
     */
    public function sendRequest($method, $url, $params);
}
