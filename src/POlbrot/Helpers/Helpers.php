<?php

namespace POlbrot\Helpers;

use POlbrot\Exceptions\InvalidJSONFileException;
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
     * @throws InvalidJSONFileException
     */
    public static function jsonFileToArray($pathToFile): array
    {
        if (file_exists($pathToFile)) {
            $string = json_decode(
                file_get_contents($pathToFile),
                true
            );
            if($string === null) throw new InvalidJSONFileException();
            else return $string;
        } else {
            throw new InvalidJSONPathException();
        }
    }
}