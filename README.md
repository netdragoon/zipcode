# Canducci Zipcode

Laravel package for [VIACEP web service](http://viacep.com.br/) - http://viacep.com.br

[![Zoom Icon](http://i666.photobucket.com/albums/vv25/netdragoon/cep_zpsoqtae5hr.png)](https://packagist.org/packages/canducci/zipcode)

[![Build Status](https://travis-ci.org/netdragoon/zipcode.svg?branch=master)](https://travis-ci.org/netdragoon/zipcode)
[![Downloads](https://img.shields.io/packagist/dt/canducci/zipcode.svg?style=flat)](https://packagist.org/packages/canducci/zipcode)
[![License](https://img.shields.io/packagist/l/canducci/zipcode.svg)](https://packagist.org/packages/canducci/zipcode)
[![Version](https://img.shields.io/packagist/v/canducci/zipcode.svg?label=version)](https://packagist.org/packages/canducci/zipcode)

[See Demo](http://zipcodedemo.herokuapp.com/)

## Quick Start with  [Composer](https://getcomposer.org/)

```sh
composer require canducci/zipcode
```

Add these classes to the end of `providers` array in `config/app.php`:

```php
'providers' => [
    // ...,
    Canducci\ZipCode\Providers\ZipCodeServiceProvider::class,
    Canducci\ZipCode\Providers\ZipCodeAddressServiceProvider::class,
],
```

And add those to the `aliases` array:

```php
'aliases' => [
    // ...,
    'ZipCode'   => Canducci\ZipCode\Facades\ZipCode::class,
    'Address'   => Canducci\ZipCode\Facades\ZipCodeAddress::class,
],
```

## How to Use It

Just pass the zipcode to any of the ways of retrieving it:

* [Facade](#facade)
* [Helper](#helper)
* [Injection](#injection)
* or [Trait](#trait)

### Facade

```php
use Canducci\ZipCode\Facades\ZipCode;

$zipCodeInfo = ZipCode::find('01414-001');
```

### Helper

```php
$zipCodeInfo = zipcode('01414000');
```

### Injection

```php
use Canducci\ZipCode\Contracts\ZipCodeContract;

public function index(ZipCodeContract $zipcode)
{
      $zipCodeInfo = $zipcode->find('01414-000');
}
```

### Trait

```php
use Canducci\ZipCode\ZipCodeTrait;

class WelcomeController extends Controller
{
    use ZipCodeTrait;

    public function index()
    {
        $zipCodeInfo =	$this->zipcode('01414000');
    }
}
```

### How to Use Summary

These is how they differ:

```php
$zipCodeInfo = ZipCode::find('01414000'); // Facade

$zipCodeInfo = $zipcode->find('01414-000'); // Contract

$zipCodeInfo = zipcode('01414000'); // Helper

$zipCodeInfo = $this->zipcode('01414-000'); // Trait
```

---

### Cache Renewal

You can force an item to renewal its cache with the second parameter:

```php
$zipCodeInfo = ZipCode::find('01414000', true); // Facade

$zipCodeInfo = $zipcode->find('01414-000', true); // Contract

$zipCodeInfo = zipcode('01414000', true); // Helper

$zipCodeInfo = $this->zipcode('01414-000', true); // Trait
```

---

### Transforming the Return Type

By default, the return type is **`null`** or an instance of **`Canducci\ZipCode\ZipCodeInfo`**, but you can transform it to any of the following common types:

* [Array](#array)
* [Json](#json)
* [Object](#object)

```php
if ($zipCodeInfo) // null or ZipCodeInfo
{
    $arr = $zipCodeInfo->getArray(); // Array

    $json = $zipCodeInfo->getJson(); // Json

    $obj = $zipCodeInfo->getObject(); // Object
}
```

#### Array

```php
if ($zipCodeInfo)
{
    $arr = $zipCodeInfo->getArray();
    /*
    Array
    (
        [cep] => 01414-001
        [logradouro] => Rua Haddock Lobo
        [bairro] => Cerqueira César
        [localidade] => São Paulo
        [uf] => SP
        [ibge] => 3550308,
        [complemento] =>
        [gia] => 1004,
        [unidade] =>
    )
    */
}
```

#### Json

```php
if ($zipCodeInfo)
{
    $json = $zipCodeInfo->getJson();
    /*
    {
        "cep": "01414-001",
        "logradouro": "Rua Haddock Lobo",
        "bairro": "Cerqueira César",
        "localidade": "São Paulo",
        "uf": "SP",
        "ibge": "3550308",
        "complemento": ""
        "gia": 1004,
        "unidade": ""
    }
    */
}
```

#### Object

```php
if ($zipCodeInfo)
{
    $obj = $zipCodeInfo->getObject();
    /*
    stdClass Object
    (
        [cep] => 01414-001
        [logradouro] => Rua Haddock Lobo
        [bairro] => Cerqueira César
        [localidade] => São Paulo
        [uf] => SP
        [ibge] => 3550308
        [complemento] =>
        [gia] => 1004
        [unidade] =>
    )
    */
}
```

---

### Seaching for all Zipcodes for a particular City, UF, Address

```php
public function get(Request $request)
{
    $uf = $request->get('uf');
    $city = $request->get('cidade');
    $address = $request->get('endereco')
    $zipcodeaddressinfo = zipcodeaddress($uf, $city, $address);
    if ($zipcodeaddressinfo)
        return $zipcodeaddressinfo->getJson();
    return Response::json(['error' => 1]);
}
```

Note: it's not mandatory to use it via helper in this case too.

---

### To add to the list of UF

```php
use Canducci\ZipCode\ZipCodeUf;

$lists = ZipCodeUf::lists();
```
