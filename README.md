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
],
```

e adicione os seus apelidos no array `aliases`:

```php
'aliases' => [
    // ...,
    'ZipCode'   => Canducci\ZipCode\Facades\ZipCode::class,
    'Address'   => Canducci\ZipCode\Facades\Address::class,
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

$response = ZipCode::find('01414-001');
```

### Helper

```php
$response = zipcode('01414000');
```

### Injection

```php
use Canducci\ZipCode\ZipCode;

public function index(ZipCode $zipcode)
{
  $response = $zipcode->find('01414-000');
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
      $response =	$this->zipcode('01414000');
    }
}
```

Há diversas formas de chegar no mesmo resultado:

```php
$response = ZipCode::find('01414000'); // Facade

$response = $zipcode->find('01414-000'); // Injection

$response = zipcode('01414000'); // Helper

$response = $this->zipcode('01414-000'); // Trait
```

---

### Tipos de retornos

Por padrão o retorno é nulo ou a instância da classe `Canducci\ZipCode\ZipCodeResponse`, e com esse retorno de classe existe os tipos `array`, `object`, `json` ou `Canducci\ZipCode\ZipCodeItem`:

- [Array](#array)
- [Json](#json)
- [Object](#object)
- [Canducci\ZipCode\ZipCodeItem](#Canducci\ZipCode\ZipCodeItem)

```php
if ($response && $response->isValid()) // null or response
{
    $arr = $response->getArray(); // Array

    $json = $response->getJson(); // Json

    $obj = $response->getObject(); // Object

    $item = $response->getZipCodeItem(); // Type `Canducci\ZipCode\ZipCodeItem`
}
```

#### Array

```php
if ($response && $response->isValid())
{
    $arr = $response->getArray();
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
if ($response && $response->isValid())
{
    $json = $response->getJson();
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
if ($response && $response->isValid())
{
    $obj = $response->getObject();
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

#### Canducci\ZipCode\ZipCodeItem

```php
if ($response && $response->isValid())
{
    $obj = $response->getZipCodeItem();
    /*
    Canducci\ZipCode\ZipCodeItem Object
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

Com a classe `Canducci\ZipCode\Address` tem um retorna de um class `Canducci\ZipCode\AdressResponse` quem implementou o `Interator` trazendo os resultados em lista em um `array` associativo:

### Facade

```php
use Canducci\ZipCode\Facades\ZipCode;

class HomeController {

  public function get(Request $request)
  {
    $uf = $request->get('uf');
    $city = $request->get('cidade');
    $street = $request->get('endereco')

    $response = ZipCode::find($uf, $city, $street);
    if ($response && $response->count() > 0)
        return $response;
    return Response::json(['error' => 1]);
  }
}
```

### Inject

```php
class HomeController {

  public function get(Request $request, Canducci\ZipCode\Adress $address)
  {
    $uf = $request->get('uf');
    $city = $request->get('cidade');
    $street = $request->get('endereco')

    $response = $address($uf, $city, $street);
    if ($response && $response->count() > 0)
        return $response;
    return Response::json(['error' => 1]);
  }
}
```

### Trait

```php
class HomeController {

  use Canducci\ZipCode\AdressTrait;

  public function get(Request $request)
  {
    $uf = $request->get('uf');
    $city = $request->get('cidade');
    $street = $request->get('endereco')

    $response = $this->address($uf, $city, $street);
    if ($response && $response->count() > 0)
        return $response;
    return Response::json(['error' => 1]);
  }
}
```

### Helper

```php
class HomeController {

  public function get(Request $request)
  {
    $uf = $request->get('uf');
    $city = $request->get('cidade');
    $street = $request->get('endereco')

    $response = address($uf, $city, $street);
    if ($response && $response->count() > 0)
        return $response;
    return Response::json(['error' => 1]);
  }
}
```

---

### Lista de Unidade Federativas da Nação (Brasil):

```php
use Canducci\ZipCode\ZipCodeUf;

$lists = ZipCodeUf::lists();
```

Resultado da lista:

```php
array(27) {
  ["AC"]=>
  string(2) "ac"
  ["AL"]=>
  string(2) "al"
  ["AP"]=>
  string(2) "ap"
  ["AM"]=>
  string(2) "am"
  ["BA"]=>
  string(2) "ba"
  ["CE"]=>
  string(2) "ce"
  ["DF"]=>
  string(2) "df"
  ["ES"]=>
  string(2) "es"
  ["GO"]=>
  string(2) "go"
  ["MA"]=>
  string(2) "ma"
  ["MT"]=>
  string(2) "mt"
  ["MS"]=>
  string(2) "ms"
  ["MG"]=>
  string(2) "mg"
  ["PR"]=>
  string(2) "pr"
  ["PB"]=>
  string(2) "pb"
  ["PA"]=>
  string(2) "pa"
  ["PE"]=>
  string(2) "pe"
  ["PI"]=>
  string(2) "pi"
  ["RJ"]=>
  string(2) "rj"
  ["RN"]=>
  string(2) "rn"
  ["RS"]=>
  string(2) "rs"
  ["RO"]=>
  string(2) "ro"
  ["RR"]=>
  string(2) "rr"
  ["SC"]=>
  string(2) "sc"
  ["SE"]=>
  string(2) "se"
  ["SP"]=>
  string(2) "sp"
  ["TO"]=>
  string(2) "to"
}
```

Essa classe `ZipCodeUf` possui as 27 constantes de Unidade Federativa da Nação que pode ser utilizados no método onde precisa passar na variável `string $uf` chamar por exemplo `ZipCodeUf::SP`, exemplo:

```php
ZipCodeUf::AC
ZipCodeUf::AL
ZipCodeUf::AP
ZipCodeUf::AM
ZipCodeUf::BA
ZipCodeUf::CE
ZipCodeUf::DF
ZipCodeUf::ES
ZipCodeUf::GO
ZipCodeUf::MA
ZipCodeUf::MT
ZipCodeUf::MS
ZipCodeUf::MG
ZipCodeUf::PR
ZipCodeUf::PB
ZipCodeUf::PA
ZipCodeUf::PE
ZipCodeUf::PI
ZipCodeUf::RJ
ZipCodeUf::RN
ZipCodeUf::RS
ZipCodeUf::RO
ZipCodeUf::RR
ZipCodeUf::SC
ZipCodeUf::SE
ZipCodeUf::SP
ZipCodeUf::TO
```
