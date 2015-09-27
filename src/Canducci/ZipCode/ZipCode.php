<?php namespace Canducci\ZipCode;

use Illuminate\Cache\CacheManager;
use GuzzleHttp\ClientInterface;
use Canducci\ZipCode\Contracts\ZipCodeContract;

class ZipCode implements ZipCodeContract {
    
    /**
     * @var $value
     */
    private $value;

    /**
     * @var $renew
     */
    private $renew;

    /**
     * @var $cacheManager (Illuminate\Cache\CacheManager)
     */
    private $cacheManager;

    /**
     * @var $clientInterface (GuzzleHttp\ClientInterface)
     */
    private $clientInterface;

    /**
     * Construct ZipCode
     *
     * @param $cacheManager (Illuminate\Cache\CacheManager)
     * @param $clientInterface (GuzzleHttp\ClientInterface)
     */
    public function __construct(CacheManager $cacheManager, ClientInterface $clientInterface)
    {

        $this->value           = '';
        $this->renew           = false;
        $this->cacheManager    = $cacheManager;        
        $this->clientInterface = $clientInterface;

    }

    /**
     * return ZipCodeInfo
     *
     * @param string $value
     * @param bool $renew
     * @return Canducci\ZipCode\ZipCodeInfo
     * @throws ZipCodeException
     */
    public function find($value, $renew = false)
    {
        $message = '';
        if (is_string($value))
        {
            $value = str_replace('.', '', $value);
            $value = str_replace('-', '', $value);
            if (mb_strlen($value) === 8 && preg_match('/^(\d){8}$/', $value)) 
            {
                $this->value = $value;                
            } 
            else 
            {
                $message = trans('canducci-zipcode::zipcode.invalid_zip');
            }
        } 
        else
        {
            $message = trans('canducci-zipcode::zipcode.invalid_zip');
        }

        if (is_bool($renew))
        {
            $this->renew = $renew;
        } 
        else 
        {
            if ($message != '')
            {
                $message .= PHP_EOL;
            }
            $message .= trans('canducci-zipcode::zipcode.invalid_argument_renew');
        }
        
        if ($message === '')
        {
            $valueInfo   = $this->getZipCodeInfo();
            if ($valueInfo === null) 
            {
                return null;
            }

            return new ZipCodeInfo($valueInfo);

        }

        throw new ZipCodeException($message);

    }

    /**
     * return JSON Javascript
     *
     * @return JSON Javascript
     * @throws ZipCodeException
     */
    private function getZipCodeInfo()
    {

        $this->renew();

        if ($this->cacheManager->has('zipcode_'.$this->value))
        {            
            $getCache = $this->cacheManager->get('zipcode_'.$this->value);            
            if (isset($getCache) && is_array($getCache))
            {   
                if (isset($getCache['erro']) && $getCache['erro'] == true)
                {
                    return null;
                }
                return json_encode($getCache, JSON_PRETTY_PRINT);
            }
        }
        else
        {                                    
            $response = $this->clientInterface->get($this->url());                
            if ($response->getStatusCode() === 200)
            {
                $getResponse = $response->json();                                               
                $this->cacheManager->put('zipcode_' . $this->value, $getResponse, 86400);                
                if (isset($getResponse['erro']) && $getResponse['erro'] == true)
                {
                    return null;
                }                
                return json_encode($getResponse, JSON_PRETTY_PRINT);
            }                       
        }
        return null;

    }    

    /**
     * remove item from cache
     *
     * @return void
     */
    private function renew()
    {

        if ($this->renew && (is_null($this->value) === false)) 
        {           
            if ($this->cacheManager->has('zipcode_' . $this->value))
            {
                $this->cacheManager->forget('zipcode_' . $this->value);
            }           
            $this->renew = false;  
        }

    }

    /**
     * get url web service
     *
     * @return string
     */
    private function url() 
    {

        return str_replace('[cep]', $this->value, 'http://viacep.com.br/ws/[cep]/json/');

    }


}