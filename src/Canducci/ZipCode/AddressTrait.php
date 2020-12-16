<?php

namespace Canducci\ZipCode;

trait AddressTrait
{
  public function address($uf, $city, $address): ?AddressResponse
  {
    return address($uf, $city, $address);
  }
}
