<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/pages/contact', 'Frontend\PagesController@contact')->name('contact');


/*
 Product routes
 All the product routes for frontend
*/
 Route::group(['prefix' => 'products'], function(){
 	Route::get('/', 'Frontend\ProductsController@index')->name('products');
 	Route::get('/{slug}', 'Frontend\ProductsController@show')->name('products.show');
 	Route::get('/new/search', 'Frontend\PagesController@search')->name('search');
	
	// categories route 	
 	Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
 	Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');
 });



 // order routes
 Route::group(['prefix' => '/orders'], function(){

 	Route::get('/', 'Backend\OrdersController@index')->name('admin.orders');

 	Route::get('/view/{id}', 'Backend\OrdersController@show')->name('admin.order.show');
 	Route::post('/delete/{id}', 'Backend\OrdersController@delete')->name('admin.order.delete');

 	Route::post('/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
 	Route::post('/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
 	Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
 	Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
 	Route::get('/invoice/{id}', 'Backend\OrdersController@generateInvoice')->name('admin.order.invoice');

 });




// user routes
Route::group(['prefix' => 'user'], function(){
	Route::get('/token/{token}', 'Frontend\VerificationController@verify')->name('user.verification');
	Route::get('/dashboard', 'Frontend\UsersController@dashboard')->name('user.dashboard');
	Route::get('/profile', 'Frontend\UsersController@profile')->name('user.profile');
	Route::post('/profile/update', 'Frontend\UsersController@profileUpdate')->name('user.profile.update');
});


// carts routes
Route::group(['prefix' => 'carts'], function(){
	Route::get('/', 'Frontend\CartsController@index')->name('carts');
	Route::post('/store', 'Frontend\CartsController@store')->name('carts.store');
	Route::post('/update/{id}', 'Frontend\CartsController@update')->name('carts.update');
	Route::post('/delete/{id}', 'Frontend\CartsController@destroy')->name('carts.delete');
});


// Checkout routes
Route::group(['prefix' => 'checkout'], function(){
	Route::get('/', 'Frontend\CheckoutsController@index')->name('checkouts');
	Route::post('/store', 'Frontend\CheckoutsController@store')->name('checkouts.store');
});


//admin routes
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'Backend\PagesController@index')->name('admin.index');
	
	// admin login route
	Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
	Route::post('/login/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

	// password email send
	Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/resetPost', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');


	// password reset send notification
	Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.reset.post');

	// product routes
	Route::group(['prefix' => '/product'], function(){

		Route::get('/', 'Backend\ProductsController@index')->name('admin.products');

		Route::get('/create', 'Backend\ProductsController@create')->name('admin.product.create');
		Route::get('/edit/{id}', 'Backend\ProductsController@edit')->name('admin.product.edit');	
		Route::get('/delete/{id}', 'Backend\ProductsController@delete')->name('admin.product.delete');

		Route::post('/store', 'Backend\ProductsController@store')->name('admin.product.store');

		Route::post('/edit/{id}', 'Backend\ProductsController@update')->name('admin.product.update');
		Route::post('/delete/{id}', 'Backend\ProductsController@delete')->name('admin.product.delete');
	});

	// Categories routes
	Route::group(['prefix' => '/categories'], function(){

		Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');

		Route::get('/create', 'Backend\CategoriesController@create')->name('admin.categories.create');
		Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.categories.edit');	
		Route::get('/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.categories.delete');

		Route::post('/store', 'Backend\CategoriesController@store')->name('admin.categories.store');

		Route::post('/edit/{id}', 'Backend\CategoriesController@update')->name('admin.categories.update');
		Route::post('/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.categories.delete');
	});


	// Brand routes
	Route::group(['prefix' => '/brancds'], function(){

		Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');

		Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');
		Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');	
		Route::get('/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');

		Route::post('/store', 'Backend\BrandsController@store')->name('admin.brand.store');

		Route::post('/brand/edit/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');
		Route::post('/brand/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');
	});


	// division routes
	Route::group(['prefix' => '/divisions'], function(){

		Route::get('/', 'Backend\DivisionsController@index')->name('admin.divisions');

		Route::get('/create', 'Backend\DivisionsController@create')->name('admin.division.create');
		Route::get('/edit/{id}', 'Backend\DivisionsController@edit')->name('admin.division.edit');	
		Route::get('/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');

		Route::post('/store', 'Backend\DivisionsController@store')->name('admin.division.store');

		Route::post('/division/edit/{id}', 'Backend\DivisionsController@update')->name('admin.division.update');
		Route::post('/division/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');
	});


	// districts routes
	Route::group(['prefix' => '/districts'], function(){

		Route::get('/', 'Backend\DistrictsController@index')->name('admin.districts');

		Route::get('/create', 'Backend\DistrictsController@create')->name('admin.district.create');
		Route::get('/edit/{id}', 'Backend\DistrictsController@edit')->name('admin.district.edit');	
		Route::get('/delete/{id}', 'Backend\DistrictsController@delete')->name('admin.district.delete');

		Route::post('/store', 'Backend\DistrictsController@store')->name('admin.district.store');

		Route::post('/division/edit/{id}', 'Backend\DistrictsController@update')->name('admin.district.update');
		Route::post('/division/delete/{id}', 'Backend\DistrictsController@delete')->name('admin.district.delete');
	});


	// sliders routes
	Route::group(['prefix' => '/sliders'], function(){

		Route::get('/', 'Backend\SlidersController@index')->name('admin.sliders');
		Route::get('/create', 'Backend\SlidersController@create')->name('admin.slider.create');
		Route::get('/edit/{id}', 'Backend\SlidersController@edit')->name('admin.slider.edit');	
		Route::get('/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');
		Route::post('/store', 'Backend\SlidersController@store')->name('admin.slider.store');

		Route::post('/slider/edit/{id}', 'Backend\SlidersController@update')->name('admin.slider.update');
		Route::post('/slider/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');
	});


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// API routes
Route::get('get-sliders/{id}', function($id){
	return json_encode( App\Models\District::where('division_id', $id)->get());
});