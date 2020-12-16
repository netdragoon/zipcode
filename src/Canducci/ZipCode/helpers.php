<?php

if (!function_exists('zipcode')) {
  /**
   * zipcode
   *
   * @param string $value
   * @return \Canducci\ZipCode\ZipCodeResponse|null
   */
  function zipcode(string $value): ?\Canducci\ZipCode\ZipCodeResponse
  {
    if (function_exists('app')) {
      $zipcode = app(\Canducci\ZipCode\ZipCode::class);
    } else {
      $cache = new \PhpExtended\SimpleCache\SimpleCacheFilesystem("./tests/tmp");
      $request = new \Canducci\ZipCode\ZipCodeRequest();
      $zipcode = new \Canducci\ZipCode\ZipCode($cache, $request);
    }
    return $zipcode->find($value);
  }
}

if (!function_exists('address')) {
  /**
   * address
   *
   * @param string $uf
   * @param string $city
   * @param string $address
   * @return \Canducci\ZipCode\AddressResponse|null
   */
  function address(string $uf, string $city, string $address): ?\Canducci\ZipCode\AddressResponse
  {
    if (function_exists('app')) {
      $address = app(\Canducci\ZipCode\Address::class);
    } else {
      $request = new \Canducci\ZipCode\ZipCodeRequest();
      $address = new \Canducci\ZipCode\Address($request);
    }
    return $address->find($uf, $city, $address);
  }
}
