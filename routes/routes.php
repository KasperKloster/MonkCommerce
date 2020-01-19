<?php
/** Admin Dashboard **/
// Group because of session & csrf
Route::group(['middleware' => ['web']], function () {

	Route::group([
		'prefix'	=> 'admin'
	], function() {
	  // Admin Dashboard Home/Index
	  Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminController@getAdminHomeIndex')->name('monk-admin-home');

		// Categories
		Route::group([
	  	'prefix'	=> 'categories'
	  ], function() {
	    Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@index')->name('monk-admin-categories-home');
	    Route::get('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@create')->name('monk-admin-create-category');
			Route::post('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@store')->name('monk-admin-store-category');
			Route::get('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@edit')->name('monk-admin-edit-category');
			Route::post('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@update')->name('monk-admin-update-category');
			Route::get('delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@destroy')->name('monk-admin-destroy-category');
	  });

	  // Products
	  Route::group([
	  	'prefix'	=> 'products'
	  ], function() {
	    Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@index')->name('monk-admin-products-home');
	    Route::get('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@create')->name('monk-admin-create-product');
			Route::post('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@store')->name('monk-admin-store-product');
			Route::get('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@edit')->name('monk-admin-edit-product');
			Route::post('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@update')->name('monk-admin-update-product');
			Route::get('delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@destroy')->name('monk-admin-destroy-product');
				// Attributes
				Route::group([
					'prefix'	=> 'attributes'
				], function() {
					Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@index')->name('monk-admin-products-attr-home');
					Route::get('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@create')->name('monk-admin-products-attr-create');
					Route::post('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@store')->name('monk-admin-products-attr-store');
					Route::get('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@edit')->name('monk-admin-products-attr-edit');
					Route::post('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@update')->name('monk-admin-products-attr-update');
					Route::get('delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductAttributeController@destroy')->name('monk-admin-products-attr-destroy');
				});
	  });

		// Orders
		Route::group([
			'prefix' => 'orders'
		], function(){
				Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminOrdersController@index')->name('monk-admin-orders-index');
				Route::get('order/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminOrdersController@show')->name('monk-admin-orders-show');
				Route::post('order/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminOrdersController@update')->name('monk-admin-orders-update');
		});

	  // Shop Settings
	  Route::group([
	    'prefix'	=> 'shop-settings'
	  ], function() {
	    Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController@index')->name('monk-admin-shop-settings');
	    Route::post('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController@store')->name('monk-admin-store-shop-informations');
			// Shipping
			Route::group([
				'prefix'	=> 'shipping'
			], function() {
				Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@index')->name('monk-admin-ship-index');
				Route::get('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@create')->name('monk-admin-courier-create');
				Route::post('store', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@store')->name('monk-admin-courier-store');
				Route::get('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@edit')->name('monk-admin-courier-edit');
				Route::post('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@update')->name('monk-admin-courier-update');
				Route::get('delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShippingSettingController@destroy')->name('monk-admin-courier-destroy');
			});

		});
		// Pages
		Route::group([
			'prefix'	=> 'pages'
		], function() {
			Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@index')->name('monk-admin-pages-index');
			Route::get('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@create')->name('monk-admin-create-page');
			Route::post('create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@store')->name('monk-admin-store-page');
			Route::get('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@edit')->name('monk-admin-edit-page');
			Route::post('edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@update')->name('monk-admin-update-page');
			Route::get('delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminStaticPages@destroy')->name('monk-admin-destroy-page');
		});
		// Emails (Dev. Purpose)
		Route::get('/emails', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminController@getEmailTest');

	});

});

/** Frontend **/
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
	Route::get('cart','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCartIndex')->name('monk-shop-cart-index');
	Route::get('checkout/billing','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutBilling')->name('monk-shop-checkout-billing');
	Route::post('checkout/billing','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutBilling')->name('monk-shop-checkout-billing-post');
	Route::get('checkout/delivery','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutDelivery')->name('monk-shop-checkout-delivery');
	Route::post('checkout/delivery','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutDelivery')->name('monk-shop-checkout-post');
	Route::get('checkout/payment','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutPayment')->name('monk-shop-checkout-payment');
	Route::post('checkout','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@postCheckoutPayment')->name('monk-shop-checkout-payment-post');
	Route::get('checkout/success','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontCheckoutController@getCheckoutSuccess')->name('monk-shop-checkout-success');
	// Static pages
	Route::get('page/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSinglePage')->name('monk-shop-single-page');
	Route::post('contact', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@postContactForm')->name('monk-shop-contact-post');
});
