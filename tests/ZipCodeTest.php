<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use Canducci\ZipCode\ZipCodeItem;
use Canducci\ZipCode\ZipCodeRequest;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
  const CACHE = __DIR__;

  public function testInstance()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $this->assertInstanceOf(ZipCode::class, $zipCode);
  }

  public function testValueCepInValid()
  {
    $this->expectException(Exception::class);
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '';
    $zipCode->find($value);
  }

  public function testValueCepValidGetArray()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '19.200-000';
    $response = $zipCode->find($value);
    $array = $response->getArray();
    $this->assertIsArray($array);
    $this->assertEquals($array['cep'], str_replace(['.'], '', $value));
  }

  public function testValueCepValidGetJson()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '19.200-000';
    $response = $zipCode->find($value);
    $json = $response->getJson();
    $this->assertIsString($json);
  }

  public function testValueCepValidGetStdClass()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '19.200-000';
    $response = $zipCode->find($value);
    $obj = $response->getObject();
    $this->assertIsObject($obj);
  }

  public function testValueCepValidGetZipCodeItem()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '01.001-000';
    $response = $zipCode->find($value);
    $zipCodeItem = $response->getZipCodeItem();
    $this->assertInstanceOf(ZipCodeItem::class, $zipCodeItem);
    $this->assertEquals($zipCodeItem->getCep(), '01001-000');
  }

  public function testValueCepValidGetZipCodeItemError()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '00000000';
    $response = $zipCode->find($value);
    $zipCodeItem = $response->getZipCodeItem();
    $this->assertInstanceOf(ZipCodeItem::class, $zipCodeItem);
    $this->assertEquals($response->getHttpCode(), 200);
    $this->assertIsInt($response->getHttpCode());
    $this->assertIsBool($response->isError());
    $this->assertTrue($response->isError());
  }
}
