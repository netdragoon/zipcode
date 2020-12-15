<?php

namespace Canducci\ZipCode;

class AddressResponse
{
  /**
   * 
   * @var array
   */
  private $httpResponse;

  /**
   *
   * @var $json
   */
  private $json;

  /**
   * 
   * @param string $json
   * @param array $httpResponse
   */
  public function __construct(string $json, array $httpResponse)
  {
    $this->json = $json;
    $this->httpResponse = $httpResponse;
  }

  /**
   * 
   * @return bool
   */
  public function isError(): bool
  {
    $array = $this->getArray();
    return isset($array['erro']) && $array['erro'] === true;
  }

  /**
   * 
   * @return int
   */
  public function getHttpCode(): int
  {
    return $this->httpResponse['http_code'];
  }

  /**
   * 
   * @return array
   */
  public function getHttpResponse(): array
  {
    return $this->httpResponse;
  }

  /**
   * 
   * @return string
   */
  public function getJson(): string
  {
    return $this->json;
  }

  /**
   * 
   * @return array
   */
  public function getArray(): array
  {
    return json_decode($this->getJson(), true);
  }

  /**
   * 
   * @return \Canducci\ZipCode\stdClass
   */
  public function getObject(): \stdClass
  {
    return json_decode($this->getJson(), false);
  }
}
