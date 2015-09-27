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
    public function find($uf, $city, $address)
    {

        $response = $this->clientInterface->get($this->url($uf, $city, $address, 'json'));

        if ($response->getStatusCode() === 200)
        {

            return new ZipCodeAddressInfo(json_encode($response->json(), JSON_PRETTY_PRINT));

        }

        return [];

    }

    protected function url($uf, $city, $address, $type)
    {


        return sprintf('viacep.com.br/ws/%s/%s/%s/%s/',
            strtolower($uf),
            strtolower($city),
            strtolower($address),
            strtolower($type)
        );

    }

}