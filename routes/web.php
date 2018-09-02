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

Route::get('/', function(){
	return redirect()->route('login');
});

Auth::routes();

Route::prefix('dashboard')->middleware(['auth', 'disable.back'])->group(function() {
	
	// Dashboard
	Route::get('home', 'Dashboard\DashboardController@index')->name('home');
	Route::get('profile/{id}', 'Dashboard\DashboardController@profile')->name('profile.index');
	Route::get('profile/{id}/edit', 'Dashboard\DashboardController@edit')->name('profile.edit');
	Route::put('profile/{id}/update', 'Dashboard\DashboardController@update')->name('profile.update');

	// Users
	Route::get('users/pdf', 'Dashboard\UserController@userPDFview')->name('user.pdf');
	Route::get('all/users/pdf', 'Dashboard\UserController@AlluserPDF')->name('all.user.pdf');
	
	Route::post('users/pdf/report', 'Dashboard\UserController@userPDFreport')->name('user.pdf.report');
	Route::resource('users', 'Dashboard\UserController');

	// Clients
	Route::get('clients/pdf', 'Dashboard\ClientController@ClientControllerPDFview')->name('client.pdf');
	Route::get('all/clients/pdf', 'Dashboard\ClientController@AllClientControllerPDF')->name('all.client.pdf');
	
	Route::post('clients/pdf/report', 'Dashboard\ClientController@userPDFreport')->name('client.pdf.report');
	Route::resource('clients', 'Dashboard\ClientController');

	Route::get('search/clients/', 'Dashboard\ClientController@search')->name('clients.search');

	// Fabricators
	Route::get('fabricators/pdf', 'Dashboard\FabricatorController@fabricatorPDFview')->name('fabricator.pdf');
	Route::get('all/fabricators/pdf', 'Dashboard\FabricatorController@AllfabricatorPDF')->name('all.fabricator.pdf');
	
	Route::post('fabricators/pdf/report', 'Dashboard\FabricatorController@fabricatorPDFreport')->name('fabricator.pdf.report');
	Route::resource('fabricators', 'Dashboard\FabricatorController');

	Route::get('search/fabricators/', 'Dashboard\FabricatorController@search')->name('fabricators.search');

	// Products
	Route::get('products/pdf', 'Dashboard\ProductController@productPDFview')->name('product.pdf');
	Route::get('all/products/pdf', 'Dashboard\ProductController@AllproductPDF')->name('all.product.pdf');
	
	Route::post('products/pdf/report', 'Dashboard\ProductController@productPDFreport')->name('product.pdf.report');
	Route::resource('products', 'Dashboard\ProductController');
	Route::get('search/products/incoming/', 'Dashboard\ProductController@searchIncoming')->name('products.searchIncoming');
	Route::get('search/products/discharged/', 'Dashboard\ProductController@searchDischarged')->name('products.searchDischarged');

	Route::post('products/service', 'Dashboard\ProductController@service')->name('products.service');

	Route::get('search/products/', 'Dashboard\ProductController@search')->name('products.search');

	// Calibrations
	Route::resource('calibrations', 'Dashboard\CalibrationController');
	Route::get('search/calibrations/', 'Dashboard\CalibrationController@search')->name('calibrations.search');

	// Request Services
	Route::get('services/pdf', 'Dashboard\ServiceController@servicePDFview')->name('services.pdf');
	Route::get('all/services/pdf', 'Dashboard\ServiceController@AllservicePDF')->name('all.services.pdf');
	
	Route::post('services/pdf/report', 'Dashboard\ServiceController@servicePDFreport')->name('services.pdf.report');
	Route::get('services/certificate/{id}', 'Dashboard\ServiceController@certificate')->name('services.certificate');
	Route::resource('services', 'Dashboard\ServiceController');

	Route::get('search/services/', 'Dashboard\ServiceController@search')->name('services.search');

	// Assigns
    Route::get('roles/assigns', 'Dashboard\RoleController@assigns')->name('assigns.index');
	
	// Roles
	Route::resource('roles', 'Dashboard\RoleController');
	
});