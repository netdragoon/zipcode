# CANDUCCI ZIPCODE (CEP BRASIL)

__Web Service provided by http://viacep.com.br/__

[![Canducci Cep](https://fulviocanducci.files.wordpress.com/2015/01/1948132_691123557596602_6995479600312612395_n.png)](https://packagist.org/packages/canducci/cep)


### Demo

[Demo Canducci ZipCode](http://zipcodedemo.herokuapp.com/)

## Quick start

### Required setup

In the `require` key of `composer.json` file add the following

```PHP
"canducci/zipcode": "1.0.*"
```

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'Canducci\ZipCode\Providers\ZipCodeServiceProvider'` to the end of the `providers` array:

```PHP
'providers' => array(
    ...,
    'Illuminate\Workbench\WorkbenchServiceProvider',
    'Canducci\ZipCode\Providers\ZipCodeServiceProvider',

),
```

At the end of `config/app.php` add `'ZipCode' => 'Canducci\ZipCode\Facade\ZipCode'` to the `aliases` array:

```PHP
'aliases' => array(
    ...,
    'View'       => 'Illuminate\Support\Facades\View',
    'ZipCode'    => 'Canducci\ZipCode\Facades\ZipCode',

),
```

##How to Use

To use is very simple, pass the ZIP and calls the various types of returns, like this:

##Facade

__Add namespace:__
```PHP
use Canducci\ZipCode\Facades\ZipCode;
```
__Code Example__
```PHP
$zipCodeInfo = ZipCode::find('01414-001');
```

##Helper

```PHP
$zipCodeInfo = zipcode('01414000');
```

##Injection
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

##Traits
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
		"gia": 1004
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
    )
}
```

##Renew item from cache

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
    )
}
```
