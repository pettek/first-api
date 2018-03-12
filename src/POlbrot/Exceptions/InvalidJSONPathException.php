<?php

namespace POlbrot\Exceptions;

use Throwable;

class InvalidJSONPathException extends \Exception
{

    /**
     * InvalidJSONPathException constructor.
     *
     * @param string         $message
     * @param int            $code
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
        return 'InvalidJSONPathException: File path to valid JSON file was not provided';
    }
}