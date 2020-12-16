<?php

namespace Canducci\ZipCode;

/**
 * ZipCodeTrait
 */
trait ZipCodeTrait
{
  /**
   * zipcode
   *
   * @param string $value
   * @return ZipCodeResponse|null
   */
  public function zipcode(string $value): ?ZipCodeResponse
  {
    return zipcode($value);
  }
}
