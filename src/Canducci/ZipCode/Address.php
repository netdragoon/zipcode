<?php

namespace Canducci\ZipCode;

/**
 * Address class
 */
class Address
{
  /**
   * $request
   *
   * @var Canducci\ZipCode\ZipCodeRequest
   */
  private $request;

  /**
   * const NAME
   */
  const NAME = "address";

  /**
   * __construct
   *
   * @param ZipCodeRequest $request
   */
  public function __construct(ZipCodeRequest $request)
  {
    $this->request = $request;
  }

  /**
   * find
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return AddressResponse|null
   */
  public function find(string $uf, string $city, string $address): ?AddressResponse
  {
    if (!$this->parse($uf, $city, $address)) {
      throw new \Exception('Uf invalid or City invalid or Adress invalid');
    }
    return $this->getOrSet($uf, $city, $address);
  }

  /**
   * parse
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return boolean
   */
  private function parse(string $uf, string $city, string $address): bool
  {
    return mb_strlen($uf) === 2 && mb_strlen($city) > 2 && mb_strlen($address) > 2;
  }

  /**
   * getOrSet
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return AddressResponse|null
   */
  private function getOrSet(string $uf, string $city, string $address): ?AddressResponse
  {
    $response = $this->request->get($this->url($uf, $city, $address));
    if (!is_null($response)) {
      return new AddressResponse($response['json'], $response['httpResponse']);
    }
    return null;
  }

  /**
   * url
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return string
   */
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
