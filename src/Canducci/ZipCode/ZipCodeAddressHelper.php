<?php

if (!function_exists('zipcodeaddress'))
{

    function zipcodeaddress($uf, $city, $address, $type)
    {

        $zip_code_address = app('Canducci\ZipCode\Contracts\ZipCodeAddressContract');

        return $zip_code_address->find($uf, $city, $address, $type);

    }

}