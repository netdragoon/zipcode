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
   * @param string $street
   * @return AddressResponse|null
   */
  public function find(string $uf, string $city, string $street): ?AddressResponse
  {
    if (!$this->parse($uf, $city, $street)) {
      throw new \Exception('Uf invalid or City invalid or Adress invalid');
    }
    return $this->getOrSet($uf, $city, $street);
  }

  /**
   * parse
   *
   * @param string $uf
   * @param string $city
   * @param string $street
   * @return boolean
   */
  private function parse(string $uf, string $city, string $street): bool
  {
    return mb_strlen($uf) === 2 && mb_strlen($city) > 2 && mb_strlen($street) > 2;
  }

  /**
   * getOrSet
   *
   * @param string $uf
   * @param string $city
   * @param string $street
   * @return AddressResponse|null
   */
  private function getOrSet(string $uf, string $city, string $street): ?AddressResponse
  {
    $response = $this->request->get($this->url($uf, $city, $street));
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
  private function url(string $uf, string $city, string $street): string
  {
    return sprintf(
      'https://viacep.com.br/ws/%s/%s/%s/json/',
      strtolower($uf),
      strtolower($city),
      strtolower($street),
    );
  }
}
