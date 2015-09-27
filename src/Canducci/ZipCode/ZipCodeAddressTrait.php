<?php namespace Canducci\ZipCode;

trait ZipCodeAddressTrait {

    /**
     * Traits ZipCodeAddress
     *
     * @param string $value
     * @param bool $renew
     * @return Canducci\ZipCode\ZipCodeAddressInfo
     */
    public function zipcodeaddress($uf, $city, $address)
    {

        return zipcodeaddress($uf, $city, $address);

    }
}