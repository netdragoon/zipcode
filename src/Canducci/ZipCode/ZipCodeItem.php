<?php

namespace Canducci\ZipCode;

/**
 * Class ZipCodeItem
 * @package Canducci\ZipCode
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
    protected $unidade;
    protected $estado;
    protected $regiao;

    /**
     * ZipCodeItem constructor.
     * @param $cep
     * @param $logradouro
     * @param $complemento
     * @param $bairro
     * @param $localidade
     * @param $uf
     * @param $ibge
     * @param $gia
     * @param $ddd
     * @param @siafi
     * @param $unidade
     * @param $estado
     * @param @regiao
     */
    public function __construct($cep, $logradouro, $complemento, $bairro, $localidade, $uf, $ibge, $gia, $ddd, $siafi, $unidade, $estado, $regiao)
    {
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->localidade = $localidade;
        $this->uf = $uf;
        $this->ibge = $ibge;
        $this->gia = $gia;
        $this->ddd = $ddd;
        $this->siafi = $siafi;
        $this->unidade = $unidade;
        $this->estado = $estado;
        $this->regiao = $regiao;
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
     * @return mixed
     */
    public function getUnidade(): string
    {
        return $this->unidade;
    }

    /**
     * @return mixed
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @return mixed
     */
    public function getRegiao(): string
    {
        return $this->regiao;
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
