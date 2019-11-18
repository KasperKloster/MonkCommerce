<?php

namespace KasperKloster\MonkCommerce;

use Illuminate\Support\ServiceProvider;

use View;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;

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
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages');
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
        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'monkcommerce');
        // Vendor Publish
        $this->publishes(
        [
          // Translations
          __DIR__.'/../resources/lang' => resource_path('lang'),
          // Seeds
          __DIR__.'/../database/seeds' => base_path('database/seeds'),
          // Styles
          __DIR__.'/../resources/assets/sass/monkcommerce-style.css' => public_path('monkcommerce/css/monkcommerce-style.css'),
          __DIR__.'/../resources/assets/sass/monkcommerce-style.css.map' => public_path('monkcommerce/css/monkcommerce-style.css.map'),
          // Product Images
          __DIR__.'/../resources/images/' => public_path('monkcommerce/images/'),
        ], 'monkcommerce');

        // For all Views
        // Storefront Navbar
        // Shop Categories
        $storefrontNavbarCategories = MonkCommerceProductCategory::whereNull('category_id')
                                      ->where('show_in_menu', 1)
                                      ->with('productChildrenCategories')
                                      ->get();
        // Shop information
        $storefrontShop = MonkCommerceShop::first();
        // Static Pages
        $storefrontStaticPages = MonkCommerceStaticPages::where('show_in_menu', 1)->get();

        View::share('storefrontNavbarCategories', $storefrontNavbarCategories);
        View::share('storefrontShop', $storefrontShop);
        View::share('storefrontStaticPages', $storefrontStaticPages);
    }
}
