<?php

namespace KasperKloster\MonkCommerce\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->loadHelpers();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    // Load Helpers File Method
    protected function loadHelpers()
    {
      foreach (glob(__DIR__.'/../Helpers/*.php') as $filename)
      {
          require_once $filename;
      }
    }
}
