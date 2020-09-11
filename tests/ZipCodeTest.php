<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use Canducci\ZipCode\ZipCodeInfo;
use Canducci\ZipCode\ZipCodeRequest;
use Canducci\ZipCode\ZipCodeTrait;
use PhpExtended\SimpleCache\SimpleCacheFilesystem;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    use ZipCodeTrait;

    public function testOk()
    {
        $this->assertNotNull('Ok');
    }


    public function getZipCodeInstance(): ZipCode
    {
        if (realpath(__DIR__ . '/tmp') === false) {
            mkdir(__DIR__ . '/tmp');
        }
        $path = realpath(__DIR__ . '/tmp');
        return new ZipCode(
            new SimpleCacheFilesystem($path),
            new ZipCodeRequest()
        );
    }

    public function getZipCodeInfoInstance(): ZipCodeInfo
    {
        $zipCode = $this->getZipCodeInstance();
        return $zipCode->find('19200000');
    }

    public function testZipCodeInfo(): void
    {
        $info = $this->getZipCodeInfoInstance();
        $this->assertNotNull($info);
    }
}
