<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use Canducci\ZipCode\ZipCodeRequest;
use Canducci\ZipCode\ZipCodeTrait;
use Illuminate\Cache\CacheManager;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Foundation\Application;

//https://packagist.org/packages/php-extended/php-simple-cache-filesystem

class ZipCodeTest extends TestCase
{
    use ZipCodeTrait;

    public function testOk()
    {
        $this->assertNotNull('Ok');
    }


    public function getZipCodeInstance(): ZipCode
    {

        $instance = new Application();
        return new ZipCode(
            new CacheManager($instance),
            new ZipCodeRequest()
        );
    }


    public function getZipCodeInfoInstance(): ZipCodeInfo
    {
        $zipCode = $this->getZipCodeInstance();
        return $zipCode->find('01414000');
    }

    public function testZipCodeInfo(): void
    {
        $info = $this->getZipCodeInstance()->find('01001000');
        $this->assertNotNull($info);
    }
}
