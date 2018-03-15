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
     * Parse a JSON file from the path provided into an array
     * If the path does not exist, throw an InvalidJSONPathException
     * If it exists, but cannot be turned into an array, throw an InvalidJSONFileException
     *
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
     * Accept an array and return one random element from it
     *
     * @param $arr
     * @return mixed
     */
    public static function pickOneRandom($arr)
    {
        return $arr[array_rand($arr)];
    }

    /**
     * Construct a string of random length from the set of chars specified
     * There are some default minimal and maximal lengths of the output string
     * Third argument specifies if the set from where the characters are randomly picked contains only numbers (true),
     * or numbers and letters (both upper- and lowercase) (DEFAULT, false)
     *
     * @param int $minLength
     * @param int $maxLength
     * @param bool $onlyNumeric
     * @return string
     */
    public static function pickRandomAlphanumeric(int $minLength = 6, int $maxLength = 30, $onlyNumeric = false): string
    {
        try {
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
        } catch (\Exception $e) {

            return '';
        }

    }

    /**
     * Construct the username based on two strings: firstName and lastName. There are some hard-coded probabilities
     * that specify how the username will be created
     *
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public static function createRandomUsername(string $firstName, string $lastName): string
    {
        try {
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
        } catch (\Exception $e) {
            return '';
        }
    }
}