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
    private $value = null;

    /**
     * ZipCodeAddressInfo constructor.
     * @param $value
     * @throws ZipCodeException
     */
    public function __construct(string $value)
    {
        if (is_string($value)) {
            $this->value = $value;
            if ($this->jsonValidate() === false) {
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
        return $this->value;
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
    public function getObject(): array
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
    private function jsonValidate()
    {
        $ret = @json_decode($this->value, true);
        return json_last_error() === JSON_ERROR_NONE && is_array($ret);
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
