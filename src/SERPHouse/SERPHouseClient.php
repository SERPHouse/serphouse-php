<?php

namespace SERPHouse;

/**
 * @property mixed $account
 * @property mixed $domains
 * @property mixed $languages
 * @property mixed $location
 * @property mixed $serpApi
 * @property mixed $trends
 */
class SERPHouseClient
{
    protected static $baseUrl = 'https://api.serphouse.com';

    protected static $key = null;

    const VERSION = '1.0';

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        self::$key = $key;
    }

    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $className = __NAMESPACE__.'\\Models\\'.ucwords($name);
        if (class_exists($className)) {
            return new $className;
        } else {
            throw new \Exception("Class $className does not exist.");
        }
    }

    public static function getKey()
    {
        return self::$key;
    }
}
