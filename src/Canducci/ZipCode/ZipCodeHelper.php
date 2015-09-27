<?php

if (!function_exists('zipcode'))
{
    /**         
     * Helper zipcode
     *
     * @param string $value
     * @param bool @renew
     * @return Canducci\ZipCode\ZipCodeInfo
     * @throws Canducci\ZipCode\ZipCodeException
     */
    function zipcode($value, $renew = false)
    {

        $zip_code = app('Canducci\ZipCode\Contracts\ZipCodeContract');

        return $zip_code->find($value, $renew);

    }

}