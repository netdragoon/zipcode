<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeAddressContract {

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @param $type
     * @return mixed
     */
    public function find($uf, $city, $address);

}