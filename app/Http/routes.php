<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace'  => 'Site'], function(){

	Route::get('/', 'HomeController@index');
	Route::post('donate', array(
		'as'   => 'donate',
		'uses' => 'HomeController@donate'
	));

	Route::get('company', array(
		'as'   	=> 'company',
		'uses'	=> 'CompanyController@index'
	));

	Route::post('signup', 'UserController@signup');

});

Route::group(['namespace' => 'Admin'], function(){

	/* FOR AUTHENTICATION/LOGIN/LOGOUT */
	Route::get('admin','AuthController@index');
	Route::get('admin/login','AuthController@index');
	Route::post('admin/login', array(
		'as'    => 'admin-form-login', 
		'uses'  => 'AuthController@index'
	));
	Route::get('logout','AuthController@logout');
	/*END HERE*/

	Route::get('admin/dashboard', 'DashboardController@index');
	Route::get('admin/donations', 'DonationsController@index');

	Route::get('admin/getDonations', 'DonationsController@getDonations');
	
	Route::get('admin/reports', 'ReportsController@index');
	Route::get('admin/reports/form/{action}', 'ReportsController@index');
	Route::get('admin/reports/form/{action}/{id}', 'ReportsController@index');
	Route::post('admin/reports/form/{action}', array(
		'as'	=> 'form-reports',
		'uses'	=> 'ReportsController@index'	
	));

	Route::get('admin/getReports', 'ReportsController@getReports');

});

Route::group(['namespace' => 'Company'], function(){
	Route::get('admin/company-profile', 'CompanyController@index');
	Route::post('admin/company-profile', array(
		'as'	=> 'company-profile',
		'uses'	=> 'CompanyController@index'	
	));
	
});