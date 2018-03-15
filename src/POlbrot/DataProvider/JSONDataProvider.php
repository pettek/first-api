<?php

namespace POlbrot\DataProvider;

use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Exceptions\InvalidJSONPathException;

/**
 * Class DataProvider
 */
class JSONDataProvider implements DataProviderInterface
{
    /** @var string */
    private $pathToFile;

    /**
     * Set $pathToFile property according to what is provided by the constructor's parameter
     * If nothing provided, throw an InvalidJSONPathException
     *
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
     * Returns an array based on contents of a file in $pathToFile property
     * If file does not exists, throw an InvalidJSONPathException
     * If the file exists but does not comply to JSON format, throw an InvalidJSONFileException
     *
     * @return array
     *
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