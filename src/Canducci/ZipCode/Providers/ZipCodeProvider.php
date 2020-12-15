<?php

namespace Canducci\ZipCode\Providers;

use Illuminate\Support\ServiceProvider;

class ZipCodeServiceProvider extends ServiceProvider
{

  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/simplecache.php' => config_path('simplecache.php'),
    ], 'simplecache');
  }

  public function register()
  {
    if (isset($this->app[\PhpExtended\SimpleCache\SimpleCacheFilesystem::class]) === false) {
      $this->app->singleton(
        'PhpExtended\SimpleCache\SimpleCacheFilesystem',
        function ($app) {
          return new \PhpExtended\SimpleCache\SimpleCacheFilesystem(config('simplecache.path') ?? __DIR__);
        }
      );
    }
    if (isset($this->app[\Canducci\ZipCode\ZipCodeRequest::class]) === false) {
      $this->app->singleton(
        \Canducci\ZipCode\ZipCodeRequest::class,
        \Canducci\ZipCode\ZipCodeRequest::class
      );
    }
    $this->app->singleton(\Canducci\ZipCode\ZipCode::class, function ($app) {
      return new \Canducci\ZipCode\ZipCode(
        $app[\PhpExtended\SimpleCache\SimpleCacheFilesystem::class],
        $app[\Canducci\ZipCode\ZipCodeRequest::class]
      );
    });
  }
}
