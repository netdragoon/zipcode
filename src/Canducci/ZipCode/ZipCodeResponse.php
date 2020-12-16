<?php

namespace Canducci\ZipCode;

/**
 * ZipCodeResponse class
 */
class ZipCodeResponse
{

    /**
     * $httpResponse
     *
     * @var array
     */
    private $httpResponse;

    /**
     * $json
     *
     * @var string
     */
    private $json;

    /**
     * __construct
     *
     * @param string $json
     * @param array $httpResponse
     */
    public function __construct(string $json, array $httpResponse)
    {
        $this->json = $json;
        $this->httpResponse = $httpResponse;
    }

    /**
     * isError
     *
     * @return boolean
     */
    public function isError(): bool
    {
        $array = $this->getArray();
        return array_key_exists('erro', $array) && $array['erro'] === true;
    }

    /**
     * isValid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        $array = $this->getArray();
        return array_key_exists('erro', $array) === false;
    }

    /**
     * getHttpCode
     *
     * @return integer
     */
    public function getHttpCode(): int
    {
        return $this->httpResponse['http_code'];
    }

    /**
     * getHttpResponse
     *
     * @return array
     */
    public function getHttpResponse(): array
    {
        return $this->httpResponse;
    }

    /**
     * getJson
     *
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }

    /**
     * getArray
     *
     * @return array
     */
    public function getArray(): array
    {
        return json_decode($this->getJson(), true);
    }

    /**
     * getObject
     *
     * @return \stdClass
     */
    public function getObject(): \stdClass
    {
        return json_decode($this->getJson(), false);
    }

    /**
     * getZipCodeItem
     *
     * @return ZipCodeItem
     */
    public function getZipCodeItem(): ZipCodeItem
    {
        return new ZipCodeItem($this->getArray());
    }
}
