<?php namespace Canducci\ZipCode\Contracts;

interface ZipCodeInfoContract {

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
     * @return ZipCodeItem
     */
    public function getZipCodeItem();
    
}
