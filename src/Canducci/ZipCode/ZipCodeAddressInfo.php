<?php namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressInfoContract;

/**
 * Class ZipCodeAddressInfo
 * @package Canducci\ZipCode
 */
class ZipCodeAddressInfo implements ZipCodeAddressInfoContract {

    /**
     * @var null|string
     */
    private $valueJson = null;

    /**
     * ZipCodeAddressInfo constructor.
     * @param $valueJson
     * @throws ZipCodeException
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
     * @return Contracts\JSON|null|string
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
     * @return Contracts\Array|mixed|null
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
     * @return mixed|null|\stdClass
     */
    public function getObject()
    {
        if (!is_null($this->valueJson))
        {
            return json_decode($this->getJson(), false);
        }
        return null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getArray());
    }

    /**
     * @return bool
     */
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
     * @return array|Contracts\Array
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