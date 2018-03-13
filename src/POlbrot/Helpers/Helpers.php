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

    /**
     * @param $arr
     * @return mixed
     */
    public static function pickOneRandom($arr)
    {
        return $arr[array_rand($arr)];
    }

    /**
     * @param int $minLength
     * @param int $maxLength
     * @return string
     */
    public static function pickRandomAlphanumeric(int $minLength = 6, int $maxLength = 30)
    {
        $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $stringLength = rand($minLength, $maxLength);

        for ($letterIndex = 0; $letterIndex < $stringLength; $letterIndex++) {
            $string .= $possibleChars[rand(0, strlen($possibleChars) - 1)];
        }

        return $string;
    }
}