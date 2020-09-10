<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeResponseContract;
use stdClass;

/**
 * Class ZipCodeResponse
 * @package Canducci\ZipCode
 */
class ZipCodeResponse implements ZipCodeResponseContract
{
    private $json;
    private $statusCode;
    public function __construct($json, $statusCode)
    {
        $this->json = $json;
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getJson(): string
    {
        return $this->json;
    }

    public function getArray(): array
    {
        return json_decode($this->getJson(), true);
    }

    public function getObject(): stdClass
    {
        return json_decode($this->getJson(), false);
    }
}
