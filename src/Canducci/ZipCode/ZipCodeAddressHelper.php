<?php

if (!function_exists('zipcodeaddress'))
{
    /**
     * @param $uf
     * @param $city
     * @param $address
     * @return \Canducci\ZipCode\ZipCodeAddressInfo
     * @throws \Canducci\ZipCode\ZipCodeException
     */
    function zipcodeaddress($uf, $city, $address)
    {
        if (function_exists('app'))
        {
            $zip_code_address = app('Canducci\ZipCode\Contracts\ZipCodeAddressContract');
        }
        else
        {
            $zip_code_address = new \Canducci\ZipCode\ZipCodeAddress(new \Canducci\ZipCode\ZipCodeRequest());
        }
        return $zip_code_address->find($uf, $city, $address);
    }

}