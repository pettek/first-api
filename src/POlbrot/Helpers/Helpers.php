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
    public static function jsonFileToArray($pathToFile): array
    {
        if ($pathToFile) {
            return json_decode(
                file_get_contents($pathToFile),
                true
            );
        }

        return [];
    }
}