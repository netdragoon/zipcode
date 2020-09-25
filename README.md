# Canducci Zipcode

### Laravel pacote do Web Service [VIACEP web service](http://viacep.com.br/) - http://viacep.com.br

---

[![Downloads](https://img.shields.io/packagist/dt/canducci/zipcode.svg?style=flat)](https://packagist.org/packages/canducci/zipcode)
[![License](https://img.shields.io/packagist/l/canducci/zipcode.svg)](https://packagist.org/packages/canducci/zipcode)
[![Version](https://img.shields.io/packagist/v/canducci/zipcode.svg?label=version)](https://packagist.org/packages/canducci/zipcode)
![PHP Composer](https://github.com/netdragoon/zipcode/workflows/PHP%20Composer/badge.svg)

[See Demo](http://zipcodedemo.herokuapp.com/)

## Utilizando composer: [Composer](https://getcomposer.org/)

```sh
composer require canducci/zipcode
```

Adicione as classes no final do array de `providers` no arquivo `config/app.php`:

```php
'providers' => [
    // ...,
    Canducci\ZipCode\Providers\ZipCodeServiceProvider::class,
    Canducci\ZipCode\Providers\ZipCodeAddressServiceProvider::class,
],
```

e adicione os seus apelidos no array `aliases`:

```php
'aliases' => [
    // ...,
    'ZipCode'   => Canducci\ZipCode\Facades\ZipCode::class,
    'Address'   => Canducci\ZipCode\Facades\ZipCodeAddress::class,
],
```

para finalizar precisa dar um:

```php
php artisan vendor:publish
```

após digitar esse comando vai aparecer um menu de opções então escolha `Canducci\ZipCode\Providers\ZipCodeServiceProvider` para publicar o arquivo de configuração (`simplecache.php`) na pasta `config/`

## Como utilizar?

Temos 4 caminhos para usufruir desse pacote:

- [Facade](#facade)
- [Helper](#helper)
- [Injection](#injection)
- or [Trait](#trait)

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

Há diversas formas de chegar no mesmo resultado:

```php
$zipCodeInfo = ZipCode::find('01414000'); // Facade

$zipCodeInfo = $zipcode->find('01414-000'); // Contract

$zipCodeInfo = zipcode('01414000'); // Helper

$zipCodeInfo = $this->zipcode('01414-000'); // Trait
```

---

### Cache renovar

Pode forçar um item a renovar seu cache com o segundo parâmetro:

```php
$zipCodeInfo = ZipCode::find('01414000', true); // Facade

$zipCodeInfo = $zipcode->find('01414-000', true); // Contract

$zipCodeInfo = zipcode('01414000', true); // Helper

$zipCodeInfo = $this->zipcode('01414-000', true); // Trait
```

---

### Tipos de retornos

Por padrão o retorno é nulo ou a instância da classe `Canducci\ZipCode\ZipCodeInfo`, e com esse retorno de classe existe os tipos `array`, `object` e `json` texto:

- [Array](#array)
- [Json](#json)
- [Object](#object)

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
        [siafi] => 0
        [ddd] = 11
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
        "ddd": "11",
        "siafi": 0
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
        [siafi] => 0
        [ddd] = 011
    )
    */
}
```

---

### Faça a buscas de varios endereços informando, `uf`, `cidade` e `endereço`:

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

---

### Lista de Unidade Federativa:

```php
use Canducci\ZipCode\ZipCodeUf;

$lists = ZipCodeUf::lists();
```
