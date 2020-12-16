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

  // public function testValueCepValidFunctionGetStdClass()
  // {
  //   $value = '19.200-000';
  //   $response = zipcode($value);  
  //   $obj = $response->getObject();
  //   $this->assertIsObject($obj);
  //   $this->assertIsBool($response->isValid());
  //   $this->assertTrue($response->isValid());
  // }

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

  public function testValueCepValidGetObjectEqualsValues()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '01001-000';
    $response = $zipCode->find($value);
    $data = $response->getObject();

    $this->assertIsObject($data);
    $this->assertEquals($response->getHttpCode(), 200);
    $this->assertIsInt($response->getHttpCode());
    $this->assertIsBool($response->isError());
    $this->assertFalse($response->isError());

    $this->assertEquals($data->cep, "01001-000");
    $this->assertEquals($data->logradouro, "Praça da Sé");
    $this->assertEquals($data->complemento, "lado ímpar");
    $this->assertEquals($data->bairro, "Sé");
    $this->assertEquals($data->localidade, "São Paulo");
    $this->assertEquals($data->uf, "SP");
    $this->assertEquals($data->ibge, "3550308");
    $this->assertEquals($data->gia, "1004");
    $this->assertEquals($data->ddd, "11");
    $this->assertEquals($data->siafi, "7107");
  }

  public function testValueCepValidGetArrayEqualsValues()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '01001-000';
    $response = $zipCode->find($value);
    $data = $response->getArray();

    $this->assertIsArray($data);
    $this->assertEquals($response->getHttpCode(), 200);
    $this->assertIsInt($response->getHttpCode());
    $this->assertIsBool($response->isError());
    $this->assertFalse($response->isError());

    $this->assertEquals($data['cep'], "01001-000");
    $this->assertEquals($data['logradouro'], "Praça da Sé");
    $this->assertEquals($data['complemento'], "lado ímpar");
    $this->assertEquals($data['bairro'], "Sé");
    $this->assertEquals($data['localidade'], "São Paulo");
    $this->assertEquals($data['uf'], "SP");
    $this->assertEquals($data['ibge'], "3550308");
    $this->assertEquals($data['gia'], "1004");
    $this->assertEquals($data['ddd'], "11");
    $this->assertEquals($data['siafi'], "7107");
  }

  public function testValueCepValidGetZipCodeItemEqualsValues()
  {
    $zipCode = new ZipCode(
      new SimpleCacheFilesystem(ZipCodeTest::CACHE),
      new ZipCodeRequest()
    );
    $value = '01001-000';
    $response = $zipCode->find($value);
    $zipCodeItem = $response->getZipCodeItem();

    $this->assertInstanceOf(ZipCodeItem::class, $zipCodeItem);
    $this->assertEquals($response->getHttpCode(), 200);
    $this->assertIsInt($response->getHttpCode());
    $this->assertIsBool($response->isError());
    $this->assertFalse($response->isError());

    $this->assertEquals($zipCodeItem->cep, "01001-000");
    $this->assertEquals($zipCodeItem->getCep(), "01001-000");

    $this->assertEquals($zipCodeItem->logradouro, "Praça da Sé");
    $this->assertEquals($zipCodeItem->getLogradouro(), "Praça da Sé");

    $this->assertEquals($zipCodeItem->complemento, "lado ímpar");
    $this->assertEquals($zipCodeItem->getComplemento(), "lado ímpar");

    $this->assertEquals($zipCodeItem->bairro, "Sé");
    $this->assertEquals($zipCodeItem->getBairro(), "Sé");

    $this->assertEquals($zipCodeItem->localidade, "São Paulo");
    $this->assertEquals($zipCodeItem->getLocalidade(), "São Paulo");

    $this->assertEquals($zipCodeItem->uf, "SP");
    $this->assertEquals($zipCodeItem->getUf(), "SP");

    $this->assertEquals($zipCodeItem->ibge, "3550308");
    $this->assertEquals($zipCodeItem->getIbge(), "3550308");

    $this->assertEquals($zipCodeItem->gia, "1004");
    $this->assertEquals($zipCodeItem->getGia(), "1004");

    $this->assertEquals($zipCodeItem->ddd, "11");
    $this->assertEquals($zipCodeItem->getDdd(), "11");

    $this->assertEquals($zipCodeItem->siafi, "7107");
    $this->assertEquals($zipCodeItem->getSiafi(), "7107");
  }
}
