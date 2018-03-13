<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 11:40
 */

namespace POlbrot\DataProvider;


/**
 * Interface DataProviderInterface
 * @package POlbrot\DataProvider
 */
interface DataProviderInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}