<?php

namespace Canducci\ZipCode;

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
     * @return mixed
     */
    public function getCep(): string
    {
        return $this->cep;
    }

    /**
     * @return mixed
     */
    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    /**
     * @return mixed
     */
    public function getComplemento(): string
    {
        return $this->complemento;
    }

    /**
     * @return mixed
     */
    public function getBairro(): string
    {
        return $this->bairro;
    }

    /**
     * @return mixed
     */
    public function getLocalidade(): string
    {
        return $this->localidade;
    }

    /**
     * @return mixed
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * @return mixed
     */
    public function getIbge(): string
    {
        return $this->ibge;
    }

    /**
     * @return mixed
     */
    public function getGia(): string
    {
        return $this->gia;
    }

    /**
     * @return mixed
     */
    public function getDdd(): string
    {
        return $this->ddd;
    }

    /**
     * @return mixed
     */
    public function getSiafi(): string
    {
        return $this->siafi;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param $name
     * @param $value
     */
    function __set($name, $value)
    {
        $this->$name = $value;
    }
}
