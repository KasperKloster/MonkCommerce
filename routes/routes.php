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

	});

});

/** Frontend **/
// Shop
Route::group(['middleware' => 'web'], function (){

	Route::group([
		'prefix' => 'shop'
	], function() {
			Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getShopIndex')->name('monk-shop-index');
			Route::get('category/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSingleCategory')->name('monk-shop-single-category');
			Route::get('product/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSingleProduct')->name('monk-shop-single-product');
			// Cart
			Route::get('cart','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getCartIndex')->name('monk-shop-cart-index');
			Route::get('add-to-cart/{id}','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getAddToCart')->name('monk-shop-add-to-cart');
			Route::get('remove-from-cart/{id}','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getRemoveFromCart')->name('monk-shop-remove-from-cart');
			Route::get('checkout','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getCheckout')->name('monk-shop-checkout');
			Route::post('checkout','KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@postCheckout')->name('monk-shop-checkout');
	});

	// Static pages
	Route::get('page/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSinglePage')->name('monk-shop-single-page');

});
