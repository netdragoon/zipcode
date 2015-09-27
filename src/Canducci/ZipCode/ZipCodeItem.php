<?php namespace Canducci\ZipCode;


class ZipCodeItem {

    protected $cep;
    protected $logradouro;
    protected $complemento;
    protected $bairro;
    protected $localidade;
    protected $uf;
    protected $ibge;
    protected $gia;

    /**
     * @param $cep
     * @param $logradouro
     * @param $complemento
     * @param $bairro
     * @param $localidade
     * @param $uf
     * @param $ibge
     * @param $gia
     */
    public function __construct($cep, $logradouro, $complemento, $bairro, $localidade, $uf, $ibge, $gia)
    {

        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->localidade = $localidade;
        $this->uf = $uf;
        $this->ibge = $ibge;
        $this->gia = $gia;

    }


    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @return mixed
     */
    public function getLocalidade()
    {
        return $this->localidade;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @return mixed
     */
    public function getIbge()
    {
        return $this->ibge;
    }

    /**
     * @return mixed
     */
    public function getGia()
    {
        return $this->gia;
    }

    function __get($name)
    {

        return $this->$name;

    }

    function __set($name, $value)
    {

        $this->$name = $value;

    }


}