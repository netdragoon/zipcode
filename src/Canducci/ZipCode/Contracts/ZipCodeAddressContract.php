<?php

namespace Canducci\ZipCode\Contracts;

interface ZipCodeAddressContract
{

    /**
     * @param string $uf
     * @param string $city
     * @param string $address
     * @param string $type
     * @return mixed
     */
    public function find(string $uf, string $city, string $address);
}
