<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeContract;
use Canducci\ZipCode\Contracts\ZipCodeRequestContract;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;

/**
 * Class ZipCode
 * @package Canducci\ZipCode
 */
class ZipCode implements ZipCodeContract
{

    /**
     * @var $value
     */
    private $value;

    /**
     * @var $renew
     */
    private $renew;

    /**
     * @var $cache
     */
    private $cache;

    /**
     * @var ZipCodeRequestContract
     */
    private $request;

    /**
     * Construct ZipCode
     *
     * @param SimpleCacheFilesystem $cache 
     * @param ZipCodeRequestContract $request
     */
    public function __construct(SimpleCacheFilesystem $cache, ZipCodeRequestContract $request)
    {
        $this->value = '';
        $this->renew = false;
        $this->cache = $cache;
        $this->request = $request;
    }

    /**
     * @param $value
     * @param bool $renew
     * @return Canducci\ZipCode\ZipCodeInfo|ZipCodeInfo|null
     * @throws ZipCodeException
     */
    public function find(string $value, bool $renew = false): ?ZipCodeInfo
    {
        $message = '';
        if (is_string($value)) {
            $value = str_replace('.', '', $value);
            $value = str_replace('-', '', $value);
            if (mb_strlen($value) === 8 && preg_match('/^(\d){8}$/', $value)) {
                $this->value = $value;
            } else {
                $message = 'ZipCode invalid';
            }
        } else {
            $message = 'ZipCode invalid';
        }
        if (is_bool($renew)) {
            $this->renew = $renew;
        } else {
            if ($message != '') {
                $message .= PHP_EOL;
            }
            $message .= 'ZipCode argument renew is invalid';
        }
        if ($message === '') {
            $valueInfo   = $this->getZipCodeInfo();
            if ($valueInfo === null) {
                return null;
            }
            return new ZipCodeInfo($valueInfo);
        }
        throw new ZipCodeException($message);
    }

    /**
     * @return null|string
     */
    private function getZipCodeInfo(): ?string
    {
        $this->renew();
        if ($this->cache->has('zipcode_' . $this->value)) {
            $getCache = $this->cache->get('zipcode_' . $this->value);
            if (isset($getCache) && is_array($getCache)) {
                if (isset($getCache['erro']) && $getCache['erro'] == true) {
                    return null;
                }
                return json_encode($getCache, JSON_PRETTY_PRINT);
            }
        } else {
            $response = $this->request->get($this->url());
            if ($response && $response->getStatusCode() === 200) {
                $getResponse = $response->getArray();
                $this->cache->set('zipcode_' . $this->value, $getResponse, 86400);
                if (isset($getResponse['erro']) && $getResponse['erro'] == true) {
                    return null;
                }
                return json_encode($getResponse);
            }
        }
        return null;
    }

    /**
     * @return mixed
     */
    private function renew(): ZipCode
    {
        if ($this->renew && (is_null($this->value) === false)) {
            if ($this->cache->has('zipcode_' . $this->value)) {
                $this->cache->delete('zipcode_' . $this->value);
            }
            $this->renew = false;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    private function url(): string
    {
        return str_replace('[cep]', $this->value, 'https://viacep.com.br/ws/[cep]/json/');
    }
}
