<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use Canducci\ZipCode\ZipCodeAddress;
use Canducci\ZipCode\ZipCodeAddressInfo;
use Canducci\ZipCode\ZipCodeInfo;
use Canducci\ZipCode\ZipCodeRequest;
use Canducci\ZipCode\ZipCodeTrait;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    use ZipCodeTrait;

    private ZipCode $zipCode;
    private ZipCodeAddress $address;

    protected function setUp(): void
    {
        $this->setZipCodeInstance();
        $this->setZipCodeAddressInstance();
    }

    public function setZipCodeInstance(): void
    {
        if (realpath(__DIR__ . '/tmp') === false) {
            mkdir(__DIR__ . '/tmp');
        }
        $path = realpath(__DIR__ . '/tmp');
        $this->zipCode = new ZipCode(
            new SimpleCacheFilesystem($path),
            new ZipCodeRequest()
        );
    }

    public function setZipCodeAddressInstance(): void
    {
        $this->address = new ZipCodeAddress(new ZipCodeRequest());
    }

    public function testZipCode(): void
    {
        $this->assertNotNull($this->zipCode);
        $this->assertInstanceOf(ZipCode::class, $this->zipCode);
    }

    public function testZipCodeAddress(): void
    {
        $this->assertNotNull($this->address);
        $this->assertInstanceOf(ZipCodeAddress::class, $this->address);
    }


    public function testZipCodeInfo(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $this->assertNotNull($zipCodeInfo);
        $this->assertInstanceOf(ZipCodeInfo::class, $zipCodeInfo);
    }

    public function testZipCodeInfoTestMethods(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $this->assertNotNull($zipCodeInfo);
        $this->assertIsString($zipCodeInfo->getJson());
        $this->assertIsArray($zipCodeInfo->getArray());
        $this->assertIsObject($zipCodeInfo->getObject());
    }

    public function testZipCodeAddressInfo(): void
    {
        $zipCodeAddressInfo = $this->address->find('sp', 'são paulo', 'ave');
        $this->assertNotNull($zipCodeAddressInfo);
        $this->assertInstanceOf(ZipCodeAddressInfo::class, $zipCodeAddressInfo);
    }

    public function testZipCodeAddressInfoTestMethods(): void
    {
        $zipCodeAddressInfo = $this->address->find('sp', 'são paulo', 'ave');
        $this->assertNotNull($zipCodeAddressInfo);
        $this->assertIsString($zipCodeAddressInfo->getJson());
        $this->assertIsArray($zipCodeAddressInfo->getArray());
        $this->assertIsArray($zipCodeAddressInfo->getObject());
        $this->assertIsNumeric($zipCodeAddressInfo->count());
    }

    public function testZipCodeReturnCep(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $data = $zipCodeInfo->getArray();
        $this->assertIsArray($data);
    }


    public function testZipCodeAddressReturnCeps(): void
    {
        $zipCodeAddressInfo = $this->address->find('sp', 'são paulo', 'ave');
        $datas = $zipCodeAddressInfo->getArray();
        $this->assertIsArray($datas);
        $this->assertEquals(50, $zipCodeAddressInfo->count());
        $this->assertArrayHasKey('cep', $datas[0]);
    }

    public function testZipCodeAddressTestKeys(): void
    {
        $zipCodeAddressInfo = $this->address->find('sp', 'são paulo', 'ave');
        $datas = $zipCodeAddressInfo->getArray();
        $this->assertArrayHasKey('cep', $datas[0]);
        $this->assertArrayHasKey('logradouro', $datas[0]);
        $this->assertArrayHasKey('complemento', $datas[0]);
        $this->assertArrayHasKey('bairro', $datas[0]);
        $this->assertArrayHasKey('localidade', $datas[0]);
        $this->assertArrayHasKey('uf', $datas[0]);
        $this->assertArrayHasKey('ddd', $datas[0]);
        $this->assertArrayHasKey('siafi', $datas[0]);
        $this->assertArrayHasKey('ibge', $datas[0]);
        $this->assertArrayHasKey('gia', $datas[0]);
    }

    public function testZipCodeFieldObject(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $model = $zipCodeInfo->getObject();

        $this->assertNotNull($model->cep);
        $this->assertNotNull($model->logradouro);
        $this->assertNotNull($model->complemento);
        $this->assertNotNull($model->bairro);
        $this->assertNotNull($model->localidade);
        $this->assertNotNull($model->uf);
        $this->assertNotNull($model->ddd);
        $this->assertNotNull($model->siafi);
        $this->assertNotNull($model->ibge);
        $this->assertNotNull($model->gia);
    }

    public function testZipCodeFieldArray(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $model = $zipCodeInfo->getArray();

        $this->assertNotNull($model['cep']);
        $this->assertNotNull($model['logradouro']);
        $this->assertNotNull($model['complemento']);
        $this->assertNotNull($model['bairro']);
        $this->assertNotNull($model['localidade']);
        $this->assertNotNull($model['uf']);
        $this->assertNotNull($model['ddd']);
        $this->assertNotNull($model['siafi']);
        $this->assertNotNull($model['ibge']);
        $this->assertNotNull($model['gia']);
    }

    public function testZipCodeTestValues(): void
    {
        $zipCodeInfo = $this->zipCode->find('01001000');
        $model = $zipCodeInfo->getArray();
        $this->assertEquals($model['cep'], '01001-000');
        $this->assertEquals($model['logradouro'], 'Praça da Sé');
        $this->assertEquals($model['complemento'], 'lado ímpar');
        $this->assertEquals($model['bairro'], 'Sé');
        $this->assertEquals($model['localidade'], 'São Paulo');
        $this->assertEquals($model['uf'], 'SP');
        $this->assertEquals($model['ddd'], '11');
        $this->assertEquals($model['siafi'], '7107');
        $this->assertEquals($model['ibge'], '3550308');
        $this->assertEquals($model['gia'], '1004');
    }

    public function testZipCodeFunctionFieldObject(): void
    {
        $zipCodeInfo = zipcode('01001000');
        $model = $zipCodeInfo->getObject();

        $this->assertNotNull($model->cep);
        $this->assertNotNull($model->logradouro);
        $this->assertNotNull($model->complemento);
        $this->assertNotNull($model->bairro);
        $this->assertNotNull($model->localidade);
        $this->assertNotNull($model->uf);
        $this->assertNotNull($model->ddd);
        $this->assertNotNull($model->siafi);
        $this->assertNotNull($model->ibge);
        $this->assertNotNull($model->gia);
    }

    public function testZipCodeFunctionFieldArray(): void
    {
        $zipCodeInfo = zipcode('01001000');
        $model = $zipCodeInfo->getArray();

        $this->assertNotNull($model['cep']);
        $this->assertNotNull($model['logradouro']);
        $this->assertNotNull($model['complemento']);
        $this->assertNotNull($model['bairro']);
        $this->assertNotNull($model['localidade']);
        $this->assertNotNull($model['uf']);
        $this->assertNotNull($model['ddd']);
        $this->assertNotNull($model['siafi']);
        $this->assertNotNull($model['ibge']);
        $this->assertNotNull($model['gia']);
    }

    public function testZipCodeFunctionTestValues(): void
    {
        $zipCodeInfo = zipcode('01001-000');
        $model = $zipCodeInfo->getArray();
        $this->assertEquals($model['cep'], '01001-000');
        $this->assertEquals($model['logradouro'], 'Praça da Sé');
        $this->assertEquals($model['complemento'], 'lado ímpar');
        $this->assertEquals($model['bairro'], 'Sé');
        $this->assertEquals($model['localidade'], 'São Paulo');
        $this->assertEquals($model['uf'], 'SP');
        $this->assertEquals($model['ddd'], '11');
        $this->assertEquals($model['siafi'], '7107');
        $this->assertEquals($model['ibge'], '3550308');
        $this->assertEquals($model['gia'], '1004');
    }
}
