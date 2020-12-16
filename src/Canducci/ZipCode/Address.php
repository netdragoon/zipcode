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

  public function find(string $uf, string $city, string $address): ?AddressResponse
  {
    if (!$this->parse($uf, $city, $address)) {
      throw new \Exception('Uf invalid or City invalid or Adress invalid');
    }
    return $this->getOrSet($uf, $city, $address);
  }

  private function parse(string $uf, string $city, string $address): bool
  {
    return mb_strlen($uf) === 2 && mb_strlen($city) > 2 && mb_strlen($address) > 2;
  }

  private function getOrSet(string $uf, string $city, string $address): ?AddressResponse
  {
    $response = $this->request->get($this->url($uf, $city, $address));
    if (!is_null($response)) {
      return new AddressResponse($response['json'], $response['httpResponse']);
    }
    return null;
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
