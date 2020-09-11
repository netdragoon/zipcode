<?php

namespace Canducci\ZipCode\Contracts;

use Canducci\ZipCode\ZipCodeItem;
use stdClass;

interface ZipCodeAddressInfoContract
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
    public function getObject(): array;

    /**
     * @return int count of array
     */
    public function count(): int;

    /**
     * @return Array of ZipCodeItem
     */
    public function getZipCodeItem(): array;
}
