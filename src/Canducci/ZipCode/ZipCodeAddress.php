<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressContract;
use Exception;

/**
 * Class ZipCodeAddress
 * @package Canducci\ZipCode
 */
class ZipCodeAddress implements ZipCodeAddressContract
{
    /**
     * @var ZipCodeRequest
     */
    private $request;

    /**
     * ZipCodeAddress constructor.
     * @param ZipCodeRequest $request
     */
    public function __construct(ZipCodeRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $uf
     * @param string $city
     * @param string $address
     * @return ZipCodeAddressInfo
     * @throws ZipCodeException
     */
    public function find(string $uf, string $city, string $address)
    {
        $message = '';
        if (strlen($uf) < 2) {
            $message .= PHP_EOL . 'Uf invalid';
        }
        if (strlen($city) < 3) {
            $message .= PHP_EOL . "City invalid";
        }
        if (strlen($address) < 3) {
            $message .= PHP_EOL . 'Address invalid';
        }
        if ($message != '') {
            throw new ZipCodeException($message);
        }
        try {
            $response = $this->request->get($this->url($uf, $city, $address, 'json'));
            if ($response && $response->getStatusCode() === 200) {
                return new ZipCodeAddressInfo($response->getJson());
            }
            throw new ZipCodeException('Request invalid', $response->getStatusCode());
        } catch (Exception $e) {
            throw new ZipCodeException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @param $type
     * @return string
     */
    protected function url($uf, $city, $address, $type)
    {
        $this->clean($uf);
        $this->clean($city);
        $this->clean($address);
        return sprintf(
            'https://viacep.com.br/ws/%s/%s/%s/%s/',
            strtolower($uf),
            strtolower($city),
            strtolower($address),
            strtolower($type)
        );
    }

    /**
     * @param $value
     * @return string
     */
    protected function clean(&$value)
    {
        $map = array(
            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'é' => 'e',
            'ê' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ú' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            'Á' => 'A',
            'À' => 'A',
            'Ã' => 'A',
            'Â' => 'A',
            'É' => 'E',
            'Ê' => 'E',
            'Í' => 'I',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ú' => 'U',
            'Ü' => 'U',
            'Ç' => 'C'
        );
        $value = strtr($value, $map);
        return $value;
    }
}
