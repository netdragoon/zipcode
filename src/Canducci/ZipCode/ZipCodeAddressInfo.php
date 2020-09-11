<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressInfoContract;
use stdClass;

/**
 * Class ZipCodeAddressInfo
 * @package Canducci\ZipCode
 */
class ZipCodeAddressInfo implements ZipCodeAddressInfoContract
{

    /**
     * @var null|string
     */
    private $valueJson = null;

    /**
     * ZipCodeAddressInfo constructor.
     * @param $valueJson
     * @throws ZipCodeException
     */
    public function __construct(string $valueJson)
    {
        if (is_string($valueJson)) {
            $this->valueJson = $valueJson;
            if ($this->json_validate_zipcodeaddress() === false) {
                throw new ZipCodeException('Format invalid');
            }
        } else {
            throw new ZipCodeException('JSON empty');
        }
    }

    /**
     * @return Contracts\JSON|null|string
     */
    public function getJson(): string
    {
        if (!is_null($this->valueJson)) {
            return $this->valueJson;
        }
        return null;
    }

    /**
     * @return Contracts\Array|mixed|null
     */
    public function getArray(): array
    {
        return json_decode($this->getJson(), true);
    }

    /**
     * @return mixed|null|\stdClass
     */
    public function getObject(): stdClass
    {
        return json_decode($this->getJson(), false);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->getArray());
    }

    /**
     * @return bool
     */
    private function json_validate_zipcodeaddress()
    {
        if (is_string($this->valueJson)) {
            $ret = @json_decode($this->valueJson, true);
            return json_last_error() === JSON_ERROR_NONE && is_array($ret);
        }
        return false;
    }

    /**
     * @return array|Contracts\Array
     */
    public function getZipCodeItem(): array
    {
        $array = array();
        foreach ($this->getArray() as $ret) {
            $array[] = new ZipCodeItem(
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
        return $array;
    }
}
