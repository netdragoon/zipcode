<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeRequestContract
{
    /**
     * @param $url
     * @return mixed
     */
    public function get($url);
}