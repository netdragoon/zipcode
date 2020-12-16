<?php

namespace Canducci\ZipCode;

use Countable;
use Iterator;

/**
 * AddressResponse class
 */
class AddressResponse implements Iterator, Countable
{
  /**
   * @var $httpResponse
   */
  private array $httpResponse;

  /**
   * @var $json
   */
  private string $json;

  /**
   * @var data 
   */
  private array $data = array();

  /**
   * @var current
   */
  private int $current = 0;

  /**
   * __construct
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

  /**
   * current
   *
   * @return array
   */
  public function current(): array
  {
    return $this->data[$this->current];
  }

  /**
   * key
   *
   * @return integer
   */
  public function key(): int
  {
    return $this->current;
  }

  /**
   * next
   *
   * @return void
   */
  public function next(): void
  {
    $this->current++;
  }

  /**
   * rewind
   *
   * @return void
   */
  public function rewind(): void
  {
    $this->current = 0;
  }

  /**
   * valid
   *
   * @return boolean
   */
  public function valid(): bool
  {
    return $this->current < count($this->data);
  }

  /**
   * count
   *
   * @return integer
   */
  public function count(): int
  {
    return count($this->data);
  }

  /**
   * all
   *
   * @return array
   */
  public function all(): array 
  {
    return $this->data;
  }
}
