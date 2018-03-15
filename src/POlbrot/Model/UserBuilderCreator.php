<?php

namespace POlbrot\Model;

use POlbrot\DataProvider\JSONDataProvider;
use POlbrot\DataProvider\TextDataProvider;
use POlbrot\Exceptions\InvalidJSONPathException;
use POlbrot\Exceptions\InvalidTextFilePathException;

/**
 * Class UserBuilderCreator
 * @package POlbrot\Model
 */
class UserBuilderCreator
{
    /**
     * Instantiates new UserBuilder and fills it with some data from files
     * Because it depends on external resources, it may throw both InvalidJSONPathException and
     * InvalidTextFilePathException meaning that the specified path was incorrect
     *
     * @return UserBuilder
     *
     * @throws InvalidJSONPathException
     * @throws InvalidTextFilePathException
     */
    public static function get(): UserBuilder
    {
        // Paths to files are hard-coded, might be moved to Config class
        $builder = new UserBuilder();

        $builder->setFirstNames(new JSONDataProvider(__DIR__ . '/../DataProvider/first-names.json'));
        $builder->setLastNames(new TextDataProvider(__DIR__ . '/../DataProvider/last-names.txt'));
        $builder->setLocations(new JSONDataProvider(__DIR__ . '/../DataProvider/locations.json'));

        return $builder;
    }
}