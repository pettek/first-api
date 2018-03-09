<?php

namespace POlbrot\Helpers;

/**
 * Class Helpers
 *
 * @package POlbrot\Helpers
 */
class Helpers
{
    /**
     * @param $pathToFile
     *
     * @return array
     */
    public static function JsonFileToArray($pathToFile): array
    {
        return json_decode(
            file_get_contents($pathToFile),
            true
        );
    }
}