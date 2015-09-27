<?php

if (!function_exists('zipcodeaddress'))
{

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @param $type
     * @return mixed
     */
    function zipcodeaddress($uf, $city, $address)
    {

        $zip_code_address = app('Canducci\ZipCode\Contracts\ZipCodeAddressContract');

        return $zip_code_address->find($uf, $city, $address);

    }

}