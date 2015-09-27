<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeAddressInfoContract {

    /**
     * return JSON Javascript
     *
     * @return JSON Javascript
     */
    public function getJson();

    /**
     * return Array
     *
     * @return Array
     */
    public function getArray();

    /**
     * return stdClass (Object)
     *
     * @return \stdClass
     */
    public function getObject();

    /**
     * @return int count of array
     */
    public function count();

    /**
     * @return Array of ZipCodeItem
     */
    public function getZipCodeItem();

}