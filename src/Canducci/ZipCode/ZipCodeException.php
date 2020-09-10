<?php

namespace Canducci\ZipCode;

use Exception;

/**
 * Class ZipCodeException
 * @package Canducci\ZipCode
 */
class ZipCodeException extends Exception
{

    /**
     * ZipCodeException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
