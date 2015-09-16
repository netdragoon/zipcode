<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeContract {
    
    /**     
     * return ZipCodeInfo
     *
     * @param $value (string)
     * @param $renew (bool)
     * @return Canducci\ZipCode\ZipCodeInfo
     * @throws Canducci\ZipCode\ZipCodeException
     */
    public function find($value, $renew = false);

}