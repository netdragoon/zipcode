<?php namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeInfoContract;


class ZipCodeInfo implements ZipCodeInfoContract {

    /**
     * @var string $valueJson
     */
    private $valueJson = null;

    /**
     * Construct ZipCodeInfo
     *
     * @param string $valueJson
     * @throws ZipCodeException
     */
    public function __construct($valueJson) 
    {

        if (is_string($valueJson))
        {
            $this->valueJson = $valueJson;
            if ($this->json_validate_zipcode() === false)
            {
                throw new ZipCodeException( trans('canducci-zipcode::zipcode.invalid_json_zip') );
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
	
    /**     
     * validate zipcode format
     *
     * @return bool
     */
    private function json_validate_zipcode() 
    {

        if (is_string($this->valueJson)) 
        {
            $ret = @json_decode($this->valueJson, true);            
            return (json_last_error() === JSON_ERROR_NONE && 
                    isset($ret['cep']) &&
                    isset($ret['logradouro']) &&
                    isset($ret['complemento']) &&
                    isset($ret['bairro']) &&
                    isset($ret['localidade']) &&
                    isset($ret['uf']) &&
                    isset($ret['ibge']) &&
                    isset($ret['gia']));
        }

        return false;

    }

    /**
     * @return ZipCodeItem
     */
    public function getZipCodeItem()
    {

        $ret = $this->getArray();

        return new ZipCodeItem(
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
}
