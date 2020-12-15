<?php

namespace Canducci\ZipCode\Contracts;

use Canducci\ZipCode\ZipCodeResponse;

interface ZipCodeRequestContract
{
    /**
     * @param $url
     * @return mixed
     */
    public function get($url): ZipCodeResponse;
}
