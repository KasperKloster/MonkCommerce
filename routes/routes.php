<?php
/** Users Dashboards **/
Route::group(['middleware' => ['web', 'auth']], function () {

	Route::group([
		'prefix'	=> 'admin'
	], function() {
	  // Admin Dashboard Home/Index
	  Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminController@getAdminHomeIndex')->name('monk-admin-home');
		Route::get('test', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminController@getTesting');
		// Categories
		Route::group([
	  	'prefix'	=> 'categories'
	  ], function() {
			Route::resource('categories', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController')->except(['show']);
	  });

	  // Products
		Route::group(['middleware' => ['admin']], function () {
	  Route::group([
	  	'prefix'	=> 'products'
	  ], function() {
				Route::resource('products', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController')->except(['show']);
				// Attributes
				Route::group([
					'prefix'	=> 'attributes'
				], function() {
					Route::resource('product-attribute', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController')->except(['show']);
				});
	  });

		});
		Route::group([
			'prefix'	=> 'users'
		], function() {
				Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminUserController@index')->name('users.index');
		});
		// Orders
		Route::group([
			'prefix' => 'orders'
		], function(){
				Route::resource('orders', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminOrdersController')->only(['index', 'show', 'update']);
		});
	  // Shop Settings
	  Route::group([
	    'prefix'	=> 'shop-settings'
	  ], function() {
			Route::resource('shop-setting', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController')->only(['index', 'store']);
			// Shipping
			Route::group([
				'prefix'	=> 'shipping'
			], function() {
					Route::resource('courier', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController')->except(['show']);
			});
		});
		// Pages
		Route::group([
			'prefix'	=> 'pages'
		], function() {
				Route::resource('static-page', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages')->except(['show']);
		});

	});

});

/** Frontend **/
// Group middleware web, because of session & csrf
Route::group(['middleware' => 'web'], function (){
	// Shop
	Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getShopIndex')->name('monk-shop-index');
	Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getShopIndex')->name('monk-shop-index');
	Route::any('category/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@anySingleCategory')->name('monk-shop-single-category');
	Route::get('product/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSingleProduct')->name('monk-shop-single-product');
	// Search
	Route::get('search', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSearchResults')->name('monk-shop-navbar-search');
	// Cart
	Route::get('add-to-cart/{id}','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getAddToCart')->name('monk-shop-add-to-cart');
	Route::get('remove-from-cart/{id}','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getRemoveFromCart')->name('monk-shop-remove-from-cart');
	// Cart and Checkout
	Route::group([
		'prefix'	=> 'cart'
	], function() {
		Route::get('/','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCartIndex')->name('monk-shop-cart-index');
		Route::get('checkout/billing','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutBilling')->name('monk-shop-checkout-billing');
		Route::post('checkout/billing','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutBilling')->name('monk-shop-checkout-billing-post');
		Route::get('checkout/delivery','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutDelivery')->name('monk-shop-checkout-delivery');
		Route::post('checkout/delivery','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutDelivery')->name('monk-shop-checkout-post');
		Route::get('checkout/payment','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutPayment')->name('monk-shop-checkout-payment');
		Route::post('checkout','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutPayment')->name('monk-shop-checkout-payment-post');
		Route::get('checkout/success','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutSuccess')->name('monk-shop-checkout-success');
	});
	// Static pages
	Route::get('page/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSinglePage')->name('monk-shop-single-page');
	Route::post('contact', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@postContactForm')->name('monk-shop-contact-post');
});
