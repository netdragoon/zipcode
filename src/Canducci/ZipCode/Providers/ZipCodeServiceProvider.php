<?php namespace Canducci\ZipCode\Providers;

use Canducci\ZipCode\ZipCode;
use Illuminate\Support\ServiceProvider;

class ZipCodeServiceProvider extends ServiceProvider
{
    public function boot()
	{
        $this->loadTranslationsFrom(__DIR__.'/../../../lang', 'canducci-zipcode');
    }
	public function register()
	{
		if (isset($this->app['Canducci\ZipCode\Contracts\ZipCodeRequestContract']) === false)
		{
			$this->app->singleton('Canducci\ZipCode\Contracts\ZipCodeRequestContract', 'Canducci\ZipCode\ZipCodeRequest');
		}
		$this->app->singleton('Canducci\ZipCode\Contracts\ZipCodeContract', function($app)
		{
			return new ZipCode($app['cache'], $app['Canducci\ZipCode\Contracts\ZipCodeRequestContract']);
		});
	}
}
