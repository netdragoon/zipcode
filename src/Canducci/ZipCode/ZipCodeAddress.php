<?php  namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeAddressContract;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

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
     * @return ZipCodeAddressInfo
     * @throws ZipCodeException
     */
    public function find($uf, $city, $address)
    {

        $message = '';
        if (strlen($uf) < 2)
        {
            $message .= PHP_EOL . trans('canducci-zipcodeaddress::zipcodeaddress.invalid_uf');
        }

        if (strlen($city) < 3)
        {
            $message .= PHP_EOL . trans('canducci-zipcodeaddress::zipcodeaddress.invalid_city');
        }

        if (strlen($address) < 3)
        {
            $message .= PHP_EOL . trans('canducci-zipcodeaddress::zipcodeaddress.invalid_address');
        }

        if ($message != '')
        {

            throw new ZipCodeException($message);

        }

        try
        {

            $response = $this->clientInterface->get($this->url($uf, $city, $address, 'json'));

            if ($response->getStatusCode() === 200)
            {

                return new ZipCodeAddressInfo(json_encode($response->json(), JSON_PRETTY_PRINT));

            }

            throw new ZipCodeException('Request inválid', $response->getStatusCode());

        }
        catch(ClientException $e)
        {

            throw new ZipCodeException($e->getMessage(), $e->getCode(), $e->getPrevious());

        }

    }

    /**
     * @param $uf
     * @param $city
     * @param $address
     * @param $type
     * @return string
     */
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