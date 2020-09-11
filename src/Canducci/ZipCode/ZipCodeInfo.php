<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeInfoContract;
use stdClass;

/**
 * Class ZipCodeInfo
 * @package Canducci\ZipCode
 */
class ZipCodeInfo implements ZipCodeInfoContract
{

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
        if (is_string($valueJson)) {
            $this->valueJson = $valueJson;
            if ($this->json_validate_zipcode() === false) {
                throw new ZipCodeException("JSON invalid");
            }
        } else {
            throw new ZipCodeException("Format invalid");
        }
    }

    /**
     * return JSON Javascript
     *
     * @return JSON Javascript
     */
    public function getJson(): string
    {
        if (!empty($this->valueJson)) {
            return $this->valueJson;
        }
        return null;
    }

    /**
     * return Array
     *
     * @return Array
     */
    public function getArray(): array
    {
        if (!empty($this->valueJson)) {
            return json_decode($this->valueJson, true);
        }
        return null;
    }

    /**
     * return stdClass (Object)
     *
     * @return \stdClass
     */
    public function getObject(): stdClass
    {
        if (!empty($this->valueJson)) {
            return json_decode($this->valueJson, false);
        }
        return null;
    }

    /**     
     * validate zipcode format
     *
     * @return bool
     */
    private function json_validate_zipcode(): bool
    {
        if (!empty($this->valueJson) && is_string($this->valueJson)) {
            $ret = @json_decode($this->valueJson, true);
            return (json_last_error() === JSON_ERROR_NONE &&
                isset($ret['cep']) &&
                isset($ret['logradouro']) &&
                isset($ret['complemento']) &&
                isset($ret['bairro']) &&
                isset($ret['localidade']) &&
                isset($ret['uf']) &&
                isset($ret['ibge']) &&
                isset($ret['gia'])) &&
                isset($ret['ddd']) &&
                isset($ret['siafi']);
        }
        return false;
    }

    /**
     * @return ZipCodeItem
     */
    public function getZipCodeItem(): ZipCodeItem
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
            $ret['gia'],
            $ret['ddd'],
            $ret['siafi']
        );
    }
}
