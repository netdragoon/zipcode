<?php

namespace Canducci\ZipCode;

trait ZipCodeTrait
{
  public function zipcode(string $value): ?ZipCodeResponse
  {
    return zipcode($value);
  }
}
