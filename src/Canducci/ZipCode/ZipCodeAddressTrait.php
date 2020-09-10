<?php

namespace Canducci\ZipCode;

/**
 * Trait ZipCodeAddressTrait
 * @package Canducci\ZipCode
 */
trait ZipCodeAddressTrait
{

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @return ZipCodeAddressInfo
     * @throws ZipCodeException
     */
    public function zipcodeaddress($uf, $city, $address)
    {
        return zipcodeaddress($uf, $city, $address);
    }
}
