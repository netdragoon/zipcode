<?php namespace Canducci\ZipCode;

trait ZipCodeTrait {

    /**
     * Traits ZipCode
     *
     * @param string $value
     * @param bool $renew
     * @return Canducci\ZipCode\ZipCodeInfo
     * @throws Canducci\ZipCode\ZipCodeException
     */
    public function zipcode($value, $renew = false)
    {

        return zipcode($value, $renew);

    }
}