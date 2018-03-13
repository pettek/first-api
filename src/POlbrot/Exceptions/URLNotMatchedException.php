<?php

namespace POlbrot\Exceptions;

use Throwable;

/**
 * Class URLNotMatchedException
 *
 * @package POlbrot\Exceptions
 */
class URLNotMatchedException extends \Exception
{
    /**
     * URLNotMatchedException constructor.
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
        return 'URLNotMatchedException: URL could not be matched to any existing endpoints';
    }
}