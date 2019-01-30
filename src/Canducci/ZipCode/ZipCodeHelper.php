<?php

if (!function_exists('zipcode'))
{
    /**
     * @param $value
     * @param bool $renew
     * @return mixed
     */
    function zipcode($value, $renew = false)
    {
        $zip_code = app('Canducci\ZipCode\Contracts\ZipCodeContract');
        return $zip_code->find($value, $renew);
    }

}