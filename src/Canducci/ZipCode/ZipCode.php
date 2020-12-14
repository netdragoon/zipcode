<?php 
declare(strict_types=1);

namespace Canducci\ZipCode;

use PhpExtended\SimpleCache\SimpleCacheFilesystem;

class ZipCode {

  public function __construct(public SimpleCacheFilesystem $cache)
  {
  }

  public function find(String $value) 
  {
    return $value;
  }
}