<?php

namespace POlbrot\Config;
/**
 * Class Config encapsulates all config data required for the correct functionality of the application
 */
class Config
{
    /** @var array */
    static private $data;

    /**
     * Config constructor. If nothing is provided initialize $data property as an empty array
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        self::$data = $data;
    }

    /**
     * Return a config data that is stored under this key. If data is not specified under this key return null
     *
     * @param string $property
     *
     * @return mixed|null
     */
    public static function get(string $property)
    {
        return self::$data[$property] ?? null;
    }
}