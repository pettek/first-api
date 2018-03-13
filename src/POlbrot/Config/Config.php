<?php

namespace POlbrot\Config;
/**
 * Class Config
 */
class Config
{
    static private $data;

    /**
     * Config constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        self::$data = $data;
    }

    /**
     * @param string $property
     *
     * @return mixed|null
     */
    static function get(string $property)
    {
        return self::$data[$property] ?? null;
    }
}