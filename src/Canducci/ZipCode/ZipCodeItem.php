<?php

namespace Canducci\ZipCode;

/**
 * ZipCodeItem class
 */
class ZipCodeItem
{

    protected $cep;
    protected $logradouro;
    protected $complemento;
    protected $bairro;
    protected $localidade;
    protected $uf;
    protected $ibge;
    protected $gia;
    protected $ddd;
    protected $siafi;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * getCep
     *
     * @return string
     */
    public function getCep(): string
    {
        return $this->cep;
    }

    /**
     * getLogradouro
     *
     * @return string
     */
    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    /**
     * getComplemento
     *
     * @return string
     */
    public function getComplemento(): string
    {
        return $this->complemento;
    }

    /**
     * getBairro
     *
     * @return string
     */
    public function getBairro(): string
    {
        return $this->bairro;
    }

    /**
     * getLocalidade
     *
     * @return string
     */
    public function getLocalidade(): string
    {
        return $this->localidade;
    }

    /**
     * getUf
     *
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * getIbge
     *
     * @return string
     */
    public function getIbge(): string
    {
        return $this->ibge;
    }

    /**
     * getGia
     *
     * @return string
     */
    public function getGia(): string
    {
        return $this->gia;
    }

    /**
     * getDdd
     *
     * @return string
     */
    public function getDdd(): string
    {
        return $this->ddd;
    }

    /**
     * getSiafi
     *
     * @return string
     */
    public function getSiafi(): string
    {
        return $this->siafi;
    }

    /**
     * __get
     *
     * @param string $name
     * @return void
     */
    function __get($name)
    {
        return $this->$name;
    }

    /**
     * __set
     *
     * @param string $name
     * @param mixed $value
     */
    function __set($name, $value)
    {
        $this->$name = $value;
    }
}
