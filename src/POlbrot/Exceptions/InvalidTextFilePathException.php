<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 13:44
 */

namespace POlbrot\Exceptions;

use Throwable;


/**
 * Class InvalidTextFilePathException
 * @package POlbrot\Exceptions
 */
class InvalidTextFilePathException extends \Exception
{
    /**
     * InvalidTextFileException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'InvalidTextFileException: File path to valid text file was not provided';
    }
}