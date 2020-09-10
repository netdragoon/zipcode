<?php

namespace Canducci\ZipCode\Contracts;

use stdClass;

interface ZipCodeResponseContract
{
    public function getStatusCode(): int;
    public function getJson(): string;
    public function getArray(): array;
    public function getObject(): stdClass;
}
