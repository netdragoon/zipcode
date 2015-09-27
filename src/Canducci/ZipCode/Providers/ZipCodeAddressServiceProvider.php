<?php namespace Canducci\ZipCode\Providers;

use Canducci\ZipCode\ZipCodeAddress;
use Illuminate\Support\ServiceProvider;

class ZipCodeAddressServiceProvider extends ServiceProvider {

    /**
     *
     */
    public function boot()
    {

        //$this->loadTranslationsFrom(__DIR__.'/../../../lang', 'canducci-zipcode');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        if (isset($this->app['GuzzleHttp\ClientInterface']) === false)
        {

            $this->app->bind('GuzzleHttp\ClientInterface', 'GuzzleHttp\Client');

        }

        $this->app->bind('Canducci\ZipCode\Contracts\ZipCodeAddressContract', function($app)
        {

            return new ZipCodeAddress($app['GuzzleHttp\ClientInterface']);

        });

    }

}