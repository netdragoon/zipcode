<?php

$dir1 = str_replace('tests','src/Canducci/ZipCode/ZipCodeTrait.php', __DIR__);
$dir2 = str_replace('tests','src/Canducci/ZipCode/ZipCodeException.php', __DIR__);

include $dir1;
include $dir2;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;


class ZipCodeTest extends TestCase
{
    use Canducci\ZipCode\ZipCodeTrait;
    
    public function setUp()
    {       
        parent::setUp();        
    }

    /**
     * @return GuzzleHttp\ClientInterface     
     */
    public function getGuzzleHttpClient() 
    {
        return $this->app->make('GuzzleHttp\ClientInterface');
    }

    /**
     * @return Canducci\ZipCode\ZipCode
     */
    public function getZipCodeInstance() 
    {
        return new Canducci\ZipCode\ZipCode(new Illuminate\Cache\CacheManager(app()),
            $this->getGuzzleHttpClient());
    }

    /**
     *
     */
    public function getZipCodeInfoInstance()
    {
        $zipCode = $this->getZipCodeInstance();
        return $zipCode->find('01414000');
    }

    /**
     * Test of Instance
     */
    public function testInstance()
    {                
        $this->assertInstanceOf('Canducci\ZipCode\Contracts\ZipCodeContract',
            $this->getZipCodeInstance());

    }

    /**
     * Test Facade
     */
    public function testFacadeToZipCodeInfoInstance()
    {
        $this->app->bind('GuzzleHttp\ClientInterface','GuzzleHttp\Client');
        $this->assertInstanceOf('Canducci\ZipCode\Contracts\ZipCodeInfoContract',
            \Canducci\ZipCode\Facades\ZipCode::find('01414000'));

    }

    /**
     * Test Helper
     */
    public function testHelperToZipCodeInfoInstance()
    {
        $this->assertInstanceOf('Canducci\ZipCode\Contracts\ZipCodeInfoContract',
            zipcode('01414000'));
    }

    /**
     * Test Traits
     */
    public function testTraitToZipCodeInfoInstance()
    {
        $this->assertInstanceOf('Canducci\ZipCode\Contracts\ZipCodeInfoContract',
            $this->zipcode('01414000'));
    }

    /**
     * Tests the same return null
     */
    public function testZipCodeInfoNull()
    {
        $zipCode = $this->getZipCodeInstance();
        $this->assertTrue(is_null($zipCode->find('00000000')));
    }

    /**
     * Tests the return not null
     */
    public function testZipCodeInfoNotNull()
    {
        $zipCode = $this->getZipCodeInstance();
        $this->assertFalse(is_null($zipCode->find('01414000')));
    }

    /**
     * Tests the return JSON Javascript
     */
    public function testZipCodeInfoReturnJSON()
    {
        $zipCodeInfo = $this->getZipCodeInfoInstance();
        $this->assertJson($zipCodeInfo->getJson());

    }

    /**
     * Tests the return Array
     */
    public function testZipCodeInfoReturnArray()
    {
        $zipCodeInfo = $this->getZipCodeInfoInstance();
        $this->assertInternalType('array',
            $zipCodeInfo->getArray());
    }

    /**
     * Tests the return Key of Array
     */
    public function testZipCodeInfoKeyOfArray()
    {
        $zipCodeInfo = $this->getZipCodeInfoInstance();
        $this->assertArrayHasKey('cep',
            $zipCodeInfo->getArray());
    }

    /**
     * Tests thrown messages "Invalid Zip"
     */
    public function testZipCodeException()
    {
        $zipCode = $this->getZipCodeInstance();
        $this->setExpectedException('Canducci\ZipCode\ZipCodeException',
            'Invalid Zip. The format valid: 01001-000 or 01001000');
        $zipCode->find('');
    }

    /**
     * Tests thrown messages "Invalid Zip"
     */
    public function testZipCodeSecondParameterException()
    {
        $zipCode = $this->getZipCodeInstance();
        $this->setExpectedException('Canducci\ZipCode\ZipCodeException',
            'Error in the second parameter should be true or false');
        $zipCode->find('19200000', '');
    }

    /**
     * Tests no found
     */
    public function testZipCodeInfoNoFind()
    {
        $zipCode = $this->getZipCodeInstance();
        $this->assertTrue(is_null($zipCode->find('11111111')));
    }
}
