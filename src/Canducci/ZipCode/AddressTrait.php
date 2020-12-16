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
   * @param string $street
   * @return AddressResponse|null
   */
  public function address(string $uf, string $city, string $street): ?AddressResponse
  {
    return address($uf, $city, $street);
  }
}
