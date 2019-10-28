<?php
//
// Route::get('calculator', function(){
//   echo 'Hello from the calculator package!';
// });


/** Admin Dashboard **/

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
	    Route::get('/create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@create')->name('monk-admin-create-category');
			Route::post('/create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@store')->name('monk-admin-store-category');
			Route::get('/edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@edit')->name('monk-admin-edit-category');
			Route::post('/edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@update')->name('monk-admin-update-category');
			Route::get('/delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductCategoryController@destroy')->name('monk-admin-destroy-category');
	  });

	  // Products
	  Route::group([
	  	'prefix'	=> 'products'
	  ], function() {
	    Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@index')->name('monk-admin-products-home');
	    Route::get('/create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@create')->name('monk-admin-create-product');
			Route::post('/create', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@store')->name('monk-admin-store-product');
			Route::get('/edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@edit')->name('monk-admin-edit-product');
			Route::post('/edit/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@update')->name('monk-admin-update-product');
			Route::get('/delete/{id}', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminProductController@destroy')->name('monk-admin-destroy-product');
	  });

	  // Shop Settings
	  Route::group([
	    'prefix'	=> 'shop-settings'
	  ], function() {
	    Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController@index')->name('monk-admin-shop-settings');
	    Route::post('/', 'KasperKloster\MonkCommerce\Http\Controllers\Admin\MonkAdminShopSettingController@store')->name('monk-admin-store-shop-informations');
	  });
	});

});

/** Frontend **/
Route::group([
	'prefix' => 'shop'
], function() {
		Route::get('/', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getShopIndex')->name('monk-shop-index');
		Route::get('category/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSingleCategory')->name('monk-shop-single-category');
		Route::get('product/{slug}', 'KasperKloster\MonkCommerce\Http\Controllers\Storefront\MonkStorefrontController@getSingleProduct')->name('monk-shop-single-product');
});
