<?php

if (!function_exists('zipcode')) {
    /**
     * @param $value
     * @param bool $renew
     * @return mixed
     */
    function zipcode($value, $renew = false)
    {
        if (function_exists('app')) {
            $zip_code = app('Canducci\ZipCode\Contracts\ZipCodeContract');
        } else {             
            $path = str_replace('Canducci\ZipCode', 'tmp', __DIR__);
            if (file_exists($path) === false){
                mkdir($path);
            }
            $cache = new \PhpExtended\SimpleCache\SimpleCacheFilesystem(new \PhpExtended\File\FileSystem($path));
            $request = new \Canducci\ZipCode\ZipCodeRequest();
            $zip_code = new \Canducci\ZipCode\ZipCode($cache, $request);
        }
        return $zip_code->find($value, $renew);
    }
}
