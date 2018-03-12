<?php

namespace POlbrot\Helpers;

use POlbrot\Exceptions\InvalidJSONPathException;

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
     * @throws InvalidJSONPathException
     */
    public static function jsonFileToArray($pathToFile): array
    {
        if (file_exists($pathToFile)) {
            return json_decode(
                file_get_contents($pathToFile),
                true
            );
        } else {
            throw new InvalidJSONPathException();
        }
    }
}