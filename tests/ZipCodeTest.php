<?php

declare(strict_types=1);

use Canducci\ZipCode\ZipCode;
use Canducci\ZipCode\ZipCodeInfo;
use Canducci\ZipCode\ZipCodeRequest;
use Canducci\ZipCode\ZipCodeTrait;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    use ZipCodeTrait;

    public function testOk()
    {
        $this->assertNotNull('Ok');
    }

    /*-
    public function getZipCodeInstance(): ZipCode
    {
        $instance = Application::make();
        return new ZipCode(
            new CacheManager($this->app),
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
    }*/
}
