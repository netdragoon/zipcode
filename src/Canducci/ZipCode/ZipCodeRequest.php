<?php

namespace Canducci\ZipCode;

use Canducci\ZipCode\Contracts\ZipCodeRequestContract;
use Exception;

/**
 * Class ZipCodeRequest
 * @package Canducci\ZipCode
 */
class ZipCodeRequest implements ZipCodeRequestContract
{
    /**
     * @param $url
     * @return ZipCodeResponse|mixed|null
     */
    public function get($url): ZipCodeResponse
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $json = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode != 200) {
                return null;
            }
            curl_close($ch);
            return new ZipCodeResponse($json, 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
