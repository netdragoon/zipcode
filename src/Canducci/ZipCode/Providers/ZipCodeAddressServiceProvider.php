<?php

namespace Canducci\ZipCode\Providers;

use Canducci\ZipCode\ZipCodeAddress;
use Illuminate\Support\ServiceProvider;

class ZipCodeAddressServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
    public function register()
    {
        if (isset($this->app['Canducci\ZipCode\Contracts\ZipCodeRequestContract']) === false) {
            $this->app->singleton('Canducci\ZipCode\Contracts\ZipCodeRequestContract', 'Canducci\ZipCode\ZipCodeRequest');
        }
        $this->app->singleton('Canducci\ZipCode\Contracts\ZipCodeAddressContract', function ($app) {
            return new ZipCodeAddress($app['Canducci\ZipCode\Contracts\ZipCodeRequestContract']);
        });
    }
}
