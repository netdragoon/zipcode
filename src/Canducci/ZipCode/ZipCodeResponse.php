<?php namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeResponseContract;

class ZipCodeResponse implements ZipCodeResponseContract
{
    private $json;
    private $statusCode;
    public function __construct($json, $statusCode)
    {
        $this->json = $json;
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getJson()
    {
        return $this->json;
    }

    public function getArray()
    {
        return json_decode($this->getJson(), true);
    }

    public function getObject()
    {
        return json_decode($this->getJson(), false);
    }
}