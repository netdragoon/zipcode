<?php

declare(strict_types=1);

use Canducci\ZipCode\Address;
use Canducci\ZipCode\AddressResponse;
use Canducci\ZipCode\ZipCodeRequest;
use PHPUnit\Framework\TestCase;


class AddressTest extends TestCase
{
  public function testInstance()
  {
    $address = new Address(
      new ZipCodeRequest()
    );
    $this->assertInstanceOf(Address::class, $address);
  }

  public function testValueAddressInvalid()
  {
    $this->expectException(Exception::class);
    $address = new Address(
      new ZipCodeRequest()
    );
    $this->assertInstanceOf(Address::class, $address);
    $address->find('', '', '');
  }

  public function testValueAddressResponse()
  {
    $address = new Address(
      new ZipCodeRequest()
    );
    $response = $address->find('sp', 'são paulo', 'ave');
    $this->assertInstanceOf(AddressResponse::class, $response);
  }

  public function testValueAddressResponseCountMoreThanZero()
  {
    $address = new Address(
      new ZipCodeRequest()
    );
    $response = $address->find('sp', 'são paulo', 'ave');
    $this->assertInstanceOf(AddressResponse::class, $response);
    $this->assertIsInt($response->count());
    $this->assertTrue($response->count() > 0);
  }

  public function testValueAddressResponseCountEquaalZero()
  {
    $address = new Address(
      new ZipCodeRequest()
    );
    $response = $address->find('sp', 'são paulosss', 'avessss');
    $this->assertInstanceOf(AddressResponse::class, $response);
    $this->assertIsInt($response->count());
    $this->assertTrue($response->count() === 0);
  }

  public function testValueAddressResponseAllToArray()
  {
    $address = new Address(
      new ZipCodeRequest()
    );
    $response = $address->find('sp', 'são paulosss', 'avessss');
    $this->assertInstanceOf(AddressResponse::class, $response);
    $this->assertIsArray($response->all());
    }
}
