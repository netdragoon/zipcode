<?php

declare(strict_types=1);

namespace Canducci\ZipCode;

use Exception;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;

class ZipCode
{

  /**
   * @var ZipCodeRequest
   */
  private $request;

  /**
   * @var SimpleCacheFilesystem
   */
  private $cache;

  /*
   * @var const NAME
  */
  const NAME = "zipcode";

  public function __construct(SimpleCacheFilesystem $cache, ZipCodeRequest $request)
  {
    $this->cache = $cache;
    $this->request = $request;
  }

  public function find(string $value): ?ZipCodeResponse
  {
    if (!$this->parse($value)) {
      throw new Exception('Cep invalid');
    }
    return $this->getOrSet($value);
  }

  private function parse(string &$value): bool
  {
    $value = str_replace(['.', '-'], [''], $value);
    return mb_strlen($value) === 8 && preg_match('/^(\d){8}$/', $value);
  }

  private function getOrSet(string $value): ?ZipCodeResponse
  {
    $name = sprintf('%s_%s', ZipCode::NAME, $value);
    $response = $this->cache->get($name);
    if (is_null($response)) {
      $data = $this->request->get($this->url($value));
      if (!is_null($data)) {
        $response = new ZipCodeResponse($data['json'], $data['httpResponse']);
        $this->cache->set($name, $response);
      }
    }
    return $response;
  }

  private function url(string $value): string
  {
    return str_replace('[cep]', $value, 'https://viacep.com.br/ws/[cep]/json/');
  }
}
