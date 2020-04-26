<?php

namespace KasperKloster\MonkCommerce\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use DB;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

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
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminOrdersController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminUserController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController');
      $this->app->make('KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController');
      // Load Views
      $this->loadViewsFrom(__DIR__.'/../../resources/views', 'monkcommerce');
      // Events
      $this->app->register(MonkCommerceEventServiceProvider::class);
      // Helpers
      $this->app->register(HelperServiceProvider::class);
      // Commands
      $this->commands(['KasperKloster\MonkCommerce\Console\Commands\AddAdmin', 'KasperKloster\MonkCommerce\Console\Commands\AddShop']);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');
        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'monkcommerce');
        // Vendor Publish
        $this->publishes(
        [
          // Translations
          __DIR__.'/../../resources/lang' => resource_path('lang'),
          // Seeds
          __DIR__.'/../../database/seeds' => base_path('database/seeds'),
          // Styles
          __DIR__.'/../../resources/assets/sass/dashboard/monkcommerce-style.min.css' => public_path('monkcommerce/css/dashboard/monkcommerce-style.min.css'),
          __DIR__.'/../../resources/assets/sass/dashboard/monkcommerce-style.css.map' => public_path('monkcommerce/css/dashboard/monkcommerce-style.css.map'),
          __DIR__.'/../../resources/assets/sass/storefront/basis/basis-style.min.css' => public_path('monkcommerce/css/storefront/basis/basis-style.min.css'),
          __DIR__.'/../../resources/assets/sass/storefront/basis/basis-style.css.map' => public_path('monkcommerce/css/storefront/basis/basis-style.css.map'),
          __DIR__.'/../../resources/assets/sass/storefront/checkout/checkout-style.min.css' => public_path('monkcommerce/css/storefront/checkout/checkout-style.min.css'),
          __DIR__.'/../../resources/assets/sass/storefront/checkout/checkout-style.css.map' => public_path('monkcommerce/css/storefront/checkout/checkout-style.css.map'),
          // JavaScript
          //__DIR__.'/../../resources/assets/js/' => public_path('monkcommerce/js/'),
          // Product Images
          __DIR__.'/../../resources/images/' => public_path('monkcommerce/images/'),
          // StoreFont View
          __DIR__.'/../../resources/views/monkcommerce-storefront/' => base_path('resources/views/monkcommerce-storefront/'),
        ], 'monkcommerce');

        /*
        * For all Views
        */
        View::composer('*', function($view)
        {
          // Shop Info
          $view->with('storefrontShop', MonkCommerceShop::first());
          // Navbar Categories
          $view->with('storefrontNavbarCategories',
                  MonkCommerceProductCategory::whereNull('category_id')
                    ->where('show_in_menu', 1)
                    ->with('productChildrenCategories')
                    ->get());
          // Static Pages
          $view->with('storefrontStaticPages', MonkCommerceStaticPages::where('show_in_menu', 1)->get());
          // Admin New Orders
          $view->with('newLeftPanelOrders', MonkCommerceOrder::where('order_status_id', 1)->count());
        });
    }
}
