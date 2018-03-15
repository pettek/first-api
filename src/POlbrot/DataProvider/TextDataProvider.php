<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 13:42
 */

namespace POlbrot\DataProvider;

use POlbrot\Exceptions\InvalidTextFileException;
use POlbrot\Exceptions\InvalidTextFilePathException;


/**
 * Class TextDataProvider
 * @package POlbrot\DataProvider
 */
class TextDataProvider implements DataProviderInterface
{
    /** @var string */
    private $pathToFile;

    /** @var string */
    private $delimiter;

    /**
     * Set $pathToFile property according to what is provided by the constructor's parameter
     * If nothing provided, throw an InvalidTextFilePathException
     * Delimiter might be specified as a second constructor's parameter, but has some default value
     *
     * @param string $pathToFile
     * @param string $delimiter
     * @throws InvalidTextFilePathException
     */
    public function __construct($pathToFile = '', $delimiter = PHP_EOL)
    {
        if ($pathToFile === '') {
            throw new InvalidTextFilePathException();
        }

        $this->pathToFile = $pathToFile;
        $this->delimiter = $delimiter;
    }

    /**
     * Returns an array based on contents of a file in $pathToFile property
     * If file does not exists, throw an InvalidTextFilePathException
     * If the file exists but cannot be exploded for some reason, throw an InvalidTextFileException
     *
     * @return array
     * @throws InvalidTextFilePathException
     * @throws InvalidTextFileException
     */
    public function toArray(): array
    {
        if (!file_exists($this->pathToFile)) {
            throw new InvalidTextFilePathException();
        }

        $array = explode(
            $this->delimiter,
            file_get_contents($this->pathToFile)
        );

        if (\count($array) === 0) {
            throw new InvalidTextFileException();
        }

        return $array;
    }
}