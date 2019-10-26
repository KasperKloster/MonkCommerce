<?php

namespace KasperKloster\MonkCommerce;

use Illuminate\Support\ServiceProvider;

use View;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class MonkCommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      // Register controllers
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController');
      // Load Views
      $this->loadViewsFrom(__DIR__.'/../resources/views', 'monkcommerce');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // Publish Styles
        $this->publishes([
            __DIR__.'/../resources/assets/sass/monkcommerce-style.css' => public_path('monkcommerce/css/monkcommerce-style.css'),
        ], 'monkcommerce');
        $this->publishes([
            __DIR__.'/../resources/assets/sass/monkcommerce-style.css.map' => public_path('monkcommerce/css/monkcommerce-style.css.map'),
        ], 'monkcommerce');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'monkcommerce');
        $this->publishes(
        [
          __DIR__.'/../resources/lang' => resource_path('lang')
        ], 'monkcommerce');

        // Seeds
        $this->publishes(
        [
          __DIR__.'/../database/seeds' => base_path('database/seeds')
        ], 'monkcommerce');

        // For all Views
        // Storefront Navbar
        $storefrontNavbarCategories = MonkCommerceProductCategory::whereNull('category_id')
                                      ->where('show_in_menu', 1)
                                      ->with('productChildrenCategories')
                                      ->get();

        $storefrontShop = MonkCommerceShop::first();

        View::share('storefrontNavbarCategories', $storefrontNavbarCategories);
        View::share('storefrontShop', $storefrontShop);

        //DEV
        //include __DIR__.'/routes.php';
        // $this->loadTranslationsFrom(__DIR__.'/path/to/translations', 'courier');
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
    }
}
