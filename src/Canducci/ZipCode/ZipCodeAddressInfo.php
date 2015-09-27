<?php namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressInfoContract;

class ZipCodeAddressInfo implements ZipCodeAddressInfoContract {

    private $valueJson = null;

    /**
     * @param $valueJson
     */
    public function __construct($valueJson)
    {
        if (is_string($valueJson))
        {

            $this->valueJson = $valueJson;
            if ($this->json_validate_zipcodeaddress() === false)
            {

                throw new ZipCodeException( trans('canducci-zipcode::zipcode.invalid_format_type_string') );

            }

        }
        else
        {

            throw new ZipCodeException( trans('canducci-zipcode::zipcode.invalid_format_type_string') );

        }


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

    private function json_validate_zipcodeaddress()
    {

        if (is_string($this->valueJson))
        {
            $ret = @json_decode($this->valueJson, true);

            return json_last_error() === JSON_ERROR_NONE && is_array($ret);

        }

        return false;

    }

    /**
     * @return Array of ZipCodeItem
     */
    public function getZipCodeItem()
    {
        $array = array();

        foreach($this->getArray() as $ret)
        {

            $array[] = new ZipCodeItem(
                $ret['cep'],
                $ret['logradouro'],
                $ret['complemento'],
                $ret['bairro'],
                $ret['localidade'],
                $ret['uf'],
                $ret['ibge'],
                $ret['gia']
            );

        }

        return $array;

    }
}