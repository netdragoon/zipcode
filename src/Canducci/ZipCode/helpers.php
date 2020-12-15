<?php

if (!function_exists('zipcode')) {
  function zipcode(string $value): \Canducci\ZipCode\ZipCodeResponse
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
