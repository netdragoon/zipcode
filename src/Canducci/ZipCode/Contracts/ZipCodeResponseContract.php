<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeResponseContract
{
    public function getStatusCode();
    public function getJson();
    public function getArray();
    public function getObject();
}