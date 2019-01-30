# CANDUCCI ZIPCODE

__Web Service provided by http://viacep.com.br/__

[![Canducci ZipCode](http://i666.photobucket.com/albums/vv25/netdragoon/cep_zpsoqtae5hr.png)](https://packagist.org/packages/canducci/zipcode)

[![Build Status](https://travis-ci.org/netdragoon/zipcode.svg?branch=master)](https://travis-ci.org/netdragoon/zipcode)
[![Packagist](https://img.shields.io/packagist/dt/canducci/zipcode.svg?style=flat)](https://packagist.org/packages/canducci/zipcode)
[![Packagist](https://img.shields.io/packagist/l/canducci/zipcode.svg)](https://packagist.org/packages/canducci/zipcode)
[![Packagist](https://img.shields.io/packagist/v/canducci/zipcode.svg?label=version)](https://packagist.org/packages/canducci/zipcode)

### Demo

[Demo Canducci ZipCode](http://zipcodedemo.herokuapp.com/)

## Quick start

### Required setup

In the `require` key of `composer.json` file add the following

```PHP
"canducci/zipcode": "2.0.*"

```

Run the Composer update comand

```bash
$ composer update
```

In your `config/app.php` add `'Canducci\ZipCode\Providers\ZipCodeServiceProvider'` and `'Canducci\ZipCode\Providers\ZipCodeAddressServiceProvider'` to the end of the `providers` array:

```PHP
'providers' => array(
    ...,
    Canducci\ZipCode\Providers\ZipCodeServiceProvider::class,
    Canducci\ZipCode\Providers\ZipCodeAddressServiceProvider::class,

),
```

At the end of `config/app.php` add `'ZipCode' => 'Canducci\ZipCode\Facade\ZipCode'` and add `'Address'` => 'Canducci\ZipCode\Facades\ZipCodeAddress'  to the `aliases` array:

```PHP

'aliases' => array(
    ...,
    'ZipCode'   => Canducci\ZipCode\Facades\ZipCode::class,
    'Address'   => Canducci\ZipCode\Facades\ZipCodeAddress::class,

),

```

## How to Use

To use is very simple, pass the ZIP and calls the various types of returns, like this:

__Package ZipCode__

## Facade

__Add namespace:__
```PHP
use Canducci\ZipCode\Facades\ZipCode;

```
__Code Example__
```PHP
$zipCodeInfo = ZipCode::find('01414-001');

```

## Helper

```PHP
$zipCodeInfo = zipcode('01414000');

```

## Injection
__Add Namespace__
```PHP
use Canducci\ZipCode\Contracts\ZipCodeContract;

```
__Code Example__
```PHP
public function index(ZipCodeContract $zipcode)
{

      $zipCodeInfo = $zipcode->find('01414000');
      
```

## Traits
__Add Namespace__
```PHP
use Canducci\ZipCode\ZipCodeTrait;

```
__Code Example__
```PHP

class WelcomeController extends Controller {

	use ZipCodeTrait;
	
	public function index()
	{
      		$zipCodeInfo =	$this->zipcode('01414000');
      	
      		
```
## Summary of How to Use
__Code__

```PHP
$zipCodeInfo = ZipCode::find('01414000', false); //Facade
$zipCodeInfo = $zipcode->find('01414000', false); //Contracts
$zipCodeInfo = zipcode('01414000', false); // Helper
$zipCodeInfo = $this->zipcode('01414000', true); //Traist
```

__Return__

The return can be null or class instance ZipCodeInfo (`Canducci\ZipCode\ZipCodeInfo`)

__Methods ZipCodeInfo__:

- _Json => `getJson()`_ 

```PHP 
if ($zipCodeInfo) 
{

    $zipCodeInfo->getJson();   
     
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
}

```

- _Array => `getArray()`_

```PHP   
if ($zipCodeInfo) 
{

    $zipCodeInfo->getArray();
    
    Array
    (
        [cep] => 01414-001
        [logradouro] => Rua Haddock Lobo
        [bairro] => Cerqueira César
        [localidade] => São Paulo
        [uf] => SP
        [ibge] => 3550308,
        [complemento] => 
        [gia] => 1004
        [unidade] => 
    )
    
}
```

- _Object => `getObject()`_ 

```PHP    
if ($zipCodeInfo) 
{
    $zipCodeInfo->getObject();    
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
}

```

## Renew item from cache

```PHP
$zipCodeInfo  = ZipCode::find('01414001', true);
if ($zipCodeInfo) 
{
    $zipCodeInfo->getObject();   
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
}
```

__Package Address__

___Obs: follows the same coding of ZipCode___

### To add to the list of UF:

```PHP
use Canducci\ZipCode\ZipCodeUf;
```

```PHP
$lists = ZipCodeUf::lists();
```

### To search for all zip of a particular city , uf and address

```PHP
public function get(Request $request)
{
    $uf = $request->get('uf');    
    $city = $request->get('cidade');    
    $address = $request->get('endereco')    
    $zipcodeaddressinfo = zipcodeaddress($uf,$city,$address);
    if ($zipcodeaddressinfo)
    {
        return $zipcodeaddressinfo->getJson();
    }    
    return Response::json(['error' => 1]);
}
```
