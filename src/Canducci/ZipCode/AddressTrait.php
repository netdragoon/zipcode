<?php

namespace Canducci\ZipCode;

/**
 * AdressTrait
 */
trait AddressTrait
{
  /**
   * address
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return AddressResponse|null
   */
  public function address(string $uf, string $city, string $address): ?AddressResponse
  {
    return address($uf, $city, $address);
  }
}
