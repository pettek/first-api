<?php

namespace POlbrot\DataProvider;

use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Exceptions\InvalidJSONPathException;

/**
 * Class DataProvider
 */
class JSONDataProvider implements DataProviderInterface
{
    private $pathToFile;

    /**
     * JSONDataProvider constructor.
     * @param string $pathToFile
     * @throws InvalidJSONPathException
     */
    public function __construct($pathToFile = '')
    {
        if ($pathToFile === '') {
            throw new InvalidJSONPathException();
        }

        $this->pathToFile = $pathToFile;
    }

    /**
     * @return array
     * @throws InvalidJSONFileException
     * @throws InvalidJSONPathException
     */
    public function toArray(): array
    {
        if (!file_exists($this->pathToFile)) {
            throw new InvalidJSONPathException();
        }

        $array = json_decode(
            file_get_contents($this->pathToFile),
            true
        );

        if ($array === null) {
            throw new InvalidJSONFileException();
        }

        return $array;
    }
}