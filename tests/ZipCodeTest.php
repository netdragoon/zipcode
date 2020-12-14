<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
  public function testInstance()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem('.')
    );
    $this->assertTrue(true);
  }
}
