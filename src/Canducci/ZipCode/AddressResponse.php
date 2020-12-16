<?php

namespace Canducci\ZipCode;

use Countable;
use Iterator;

class AddressResponse implements Iterator, Countable
{
  /**
   * 
   * @var array
   */
  private array $httpResponse;

  /**
   *
   * @var $json
   */
  private string $json;

  /**
   * 
   * @var data 
   */
  private array $data = array();

  /**
   * 
   * @var current
   */
  private int $current = 0;

  /**
   * 
   * @param string $json
   * @param array $httpResponse
   */
  public function __construct(string $json, array $httpResponse)
  {
    $this->current = 0;
    $this->json = $json;
    $this->httpResponse = $httpResponse;
    if (!empty($this->json)) {
      $this->data = json_decode($this->json, true);
    }
  }

  public function current()
  {
    return $this->data[$this->current];
  }

  public function key(): int
  {
    return $this->current;
  }

  public function next(): void
  {
    $this->current++;
  }

  public function rewind(): void
  {
    $this->current = 0;
  }

  public function valid(): bool
  {
    return $this->current < count($this->data);
  }

  public function count(): int
  {
    return count($this->data);
  }
}
