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
    private $pathToFile;
    private $delimiter;

    /**
     * TextDataProvider constructor.
     * @param $pathToFile
     * @param string $delimiter
     * @throws InvalidTextFilePathException
     */
    public function __construct($pathToFile, $delimiter = PHP_EOL)
    {
        if ($pathToFile === '') throw new InvalidTextFilePathException();

        $this->pathToFile = $pathToFile;
        $this->delimiter = $delimiter;
    }

    /**
     * @return array
     * @throws InvalidTextFilePathException
     * @throws InvalidTextFileException
     */
    public function toArray(): array
    {
        if (!file_exists($this->pathToFile)) throw new InvalidTextFilePathException();

        $array = explode(
            $this->delimiter,
            file_get_contents($this->pathToFile)
        );

        if (count($array) === 0) throw new InvalidTextFileException();

        return $array;
    }
}