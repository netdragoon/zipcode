<?php

namespace Canducci\ZipCode\Contracts;

use Canducci\ZipCode\ZipCodeInfo;

interface ZipCodeContract
{

    /**     
     * return ZipCodeInfo
     *
     * @param $value (string)
     * @param $renew (bool)
     * @return Canducci\ZipCode\ZipCodeInfo
     * @throws Canducci\ZipCode\ZipCodeException
     */
    public function find(string $value, bool $renew = false): ?ZipCodeInfo;
}
