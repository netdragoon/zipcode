<?php

namespace Canducci\ZipCode;

class ZipCodeRequest {
    public function get($url): ZipCodeResponse
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $json = curl_exec($ch);
            $httpResponse = curl_getinfo($ch);
            if ($httpResponse['http_code'] != 200) {
                return null;
            }
            curl_close($ch);
            return new ZipCodeResponse($json, $httpResponse);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
