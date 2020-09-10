<?php

namespace Canducci\ZipCode\Contracts;

use Canducci\ZipCode\ZipCodeItem;
use stdClass;

interface ZipCodeInfoContract
{

    /**
     * return JSON Javascript 
     *
     * @return JSON Javascript
     */
    public function getJson(): string;

    /**
     * return Array
     *
     * @return Array
     */
    public function getArray(): array;

    /**
     * return stdClass (Object)
     *
     * @return \stdClass
     */
    public function getObject(): stdClass;


    /**
     * @return ZipCodeItem
     */
    public function getZipCodeItem(): ZipCodeItem;
}
