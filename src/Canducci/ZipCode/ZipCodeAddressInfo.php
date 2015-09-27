<?php namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressInfoContract;

class ZipCodeAddressInfo implements ZipCodeAddressInfoContract {

    private $valueJson = null;

    /**
     * @param $valueJson
     */
    public function __construct($valueJson)
    {

        $this->valueJson = $valueJson;

    }
    /**
     * return JSON Javascript
     *
     * @return JSON Javascript
     */
    public function getJson()
    {

        if (!is_null($this->valueJson))
        {
            return $this->valueJson;
        }

        return null;
    }

    /**
     * return Array
     *
     * @return Array
     */
    public function getArray()
    {

        if (!is_null($this->valueJson))
        {
            return json_decode($this->getJson(), true);
        }

        return null;

    }

    /**
     * return stdClass (Object)
     *
     * @return \stdClass
     */
    public function getObject()
    {

        if (!is_null($this->valueJson))
        {

            return json_decode($this->getJson(), false);

        }

        return null;

    }

    public function count()
    {

        return count($this->getArray());

    }
}