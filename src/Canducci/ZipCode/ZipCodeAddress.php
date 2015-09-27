<?php  namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressContract;
use GuzzleHttp\ClientInterface;

class ZipCodeAddress implements ZipCodeAddressContract {

    /**
     * @var $clientInterface (GuzzleHttp\ClientInterface)
     */
    private $clientInterface;

    /**
     * @param ClientInterface $clientInterface
     */
    public function __construct(ClientInterface $clientInterface)
    {

        $this->clientInterface = $clientInterface;

    }

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @param $type
     * @return mixed|void
     */
<<<<<<< HEAD

    public function find($uf, $city, $address, $type)
    {

=======
    public function find($uf, $city, $address, $type)
    {
>>>>>>> e68d86f286d5fdd55122bb467875cb5ce9d51c02
        $response = $this->clientInterface->get($this->url($uf, $city, $address, $type));

        if ($response->getStatusCode() === 200)
        {
<<<<<<< HEAD

            return new ZipCodeAddressInfo(json_encode($response->json(), JSON_PRETTY_PRINT));

        }

        return [];

=======
            return $response->json();
        }

        return [];
>>>>>>> e68d86f286d5fdd55122bb467875cb5ce9d51c02
    }

    protected function url($uf, $city, $address, $type)
    {

<<<<<<< HEAD
        return sprintf('viacep.com.br/ws/%s/%s/%s/%s/',
            strtolower($uf),
            strtolower($city),
            strtolower($address),
            strtolower($type)
        );
=======
        return sprintf('viacep.com.br/ws/%s/%s/%s/%s/', $uf, $city, $address, $type);
>>>>>>> e68d86f286d5fdd55122bb467875cb5ce9d51c02

    }

}