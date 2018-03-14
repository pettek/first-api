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
            if ($string === null) throw new InvalidJSONFileException();
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
     * @param bool $onlyNumeric
     * @return string
     */
    public static function pickRandomAlphanumeric(int $minLength = 6, int $maxLength = 30, $onlyNumeric = false)
    {
        if($onlyNumeric) $possibleChars = '0123456789';
        else $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $string = '';
        $stringLength = mt_rand($minLength, $maxLength);

        for ($letterIndex = 0; $letterIndex < $stringLength; $letterIndex++) {
            $string .= $possibleChars[mt_rand(0, strlen($possibleChars) - 1)];
        }

        return $string;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public static function createRandomUsername(string $firstName, string $lastName)
    {
        if (mt_rand(0, 9) < 9) {//90% probability
            $delimiterRand = mt_rand(0, 99);

            if ($delimiterRand < 33) {       //33% probability
                $delimiter = '.';
            } elseif ($delimiterRand < 66) { //33% probability
                $delimiter = '_';
            } else {                         //remaining 34% probability
                $delimiter = '';
            }
            $username = $firstName . $delimiter . $lastName;
        } else {                  //10% probability
            $username = $firstName;
        }

        if (mt_rand(0, 100) < 46) {//46% probability
            $username = $username . mt_rand(1, 100);
        }

        return $username;
    }
}