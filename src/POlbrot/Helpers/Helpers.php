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
            if ($string === null) {
                throw new InvalidJSONFileException();
            }

            return $string;
        }

        throw new InvalidJSONPathException();
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
     * @throws \Exception
     */
    public static function pickRandomAlphanumeric(int $minLength = 6, int $maxLength = 30, $onlyNumeric = false): string
    {
        if ($onlyNumeric) {
            $possibleChars = '0123456789';
        } else {
            $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }

        $string = '';
        $stringLength = random_int($minLength, $maxLength);

        for ($letterIndex = 0; $letterIndex < $stringLength; $letterIndex++) {
            $string .= $possibleChars[random_int(0, \strlen($possibleChars) - 1)];
        }

        return $string;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     * @throws \Exception
     */
    public static function createRandomUsername(string $firstName, string $lastName)
    {
        if (random_int(0, 9) < 9) {//90% probability
            $delimiterRand = random_int(0, 99);

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

        if (random_int(0, 100) < 46) {//46% probability
            $username .= random_int(1, 100);
        }

        return $username;
    }
}