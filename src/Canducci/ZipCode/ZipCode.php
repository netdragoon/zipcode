<?php namespace Canducci\ZipCode;

use Illuminate\Cache\CacheManager;
use Canducci\ZipCode\Contracts\ZipCodeContract;
use Canducci\ZipCode\Contracts\ZipCodeRequestContract;

/**
 * Class ZipCode
 * @package Canducci\ZipCode
 */
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
     * @var ZipCodeRequestContract
     */
    private $request;

    /**
     * Construct ZipCode
     *
     * @param CacheManager $cacheManager (Illuminate\Cache\CacheManager)
     * @param ZipCodeRequestContract $request
     */
    public function __construct(CacheManager $cacheManager, ZipCodeRequestContract $request)
    {
        $this->value = '';
        $this->renew = false;
        $this->cacheManager = $cacheManager;
        $this->request = $request;
    }

    /**
     * @param $value
     * @param bool $renew
     * @return Canducci\ZipCode\ZipCodeInfo|ZipCodeInfo|null
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
     * @return null|string
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
            $response = $this->request->get($this->url());
            if ($response && $response->getStatusCode() === 200)
            {
                $getResponse = $response->getArray();
                $this->cacheManager->put('zipcode_' . $this->value, $getResponse, 86400);                
                if (isset($getResponse['erro']) && $getResponse['erro'] == true)
                {
                    return null;
                }                
                return json_encode($getResponse);
            }                       
        }
        return null;
    }

    /**
     * @return mixed
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
        return this;
    }

    /**
     * @return mixed
     */
    private function url()
    {
        return str_replace('[cep]', $this->value, 'http://viacep.com.br/ws/[cep]/json/');
    }

}