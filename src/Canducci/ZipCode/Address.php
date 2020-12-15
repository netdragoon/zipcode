<?php

namespace Canducci\ZipCode;

class Address
{
  /**
   * @var $request
   */
  private $request;

  /*
   * @var const NAME
  */
  const NAME = "address";

  /**
   * 
   */
  public function __construct(ZipCodeRequest $request)
  {
    $this->request = $request;
  }

  public function find(string $uf, string $city, string $address)
  {
    if (!$this->parse($uf, $city, $address)) {
      throw new \Exception('Data invalid');
    }
    return $this->getOrSet($uf, $city, $address);
  }

  private function parse(string $uf, string $city, string $address): bool
  {
    return mb_strlen($uf) === 2 &&
      mb_strlen($city) > 3 &&
      mb_strlen($address) > 3;
  }

  private function getOrSet(string $uf, string $city, string $address)
  {
    $response = $this->request->get($this->url($uf, $city, $address));
  }

  private function url(string $uf, string $city, string $address): string
  {
    return sprintf(
      'https://viacep.com.br/ws/%s/%s/%s/json/',
      strtolower($uf),
      strtolower($city),
      strtolower($address),
    );
  }
}
