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
     * @return UserBuilder
     * @throws InvalidJSONPathException
     * @throws InvalidTextFilePathException
     */
    public static function get()
    {
        $builder = new UserBuilder();
        $builder->setFirstNames(new JSONDataProvider(__DIR__ . '/../DataProvider/first-names.json'));
        $builder->setLastNames(new TextDataProvider(__DIR__ . '/../DataProvider/last-names.txt'));
        $builder->setLocations(new JSONDataProvider(__DIR__ . '/../DataProvider/locations.json'));

        return $builder;
    }
}