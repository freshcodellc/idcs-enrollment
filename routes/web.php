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

Route::get('/', 'WelcomeController@index')->name("welcome");
Route::post('/', 'WelcomeController@getStarted')->name("get_started");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/payment', 'HomeController@payment')->name('charge_payment');
Route::get('/home/enroll', 'HomeController@enroll')->name('enroll');
Route::get('/home/create-plan', 'HomeController@createSubscriptionPlan')->name('create_sub_plan');

Route::get('/home/kba', 'KbaController@index')->name('kba');

Route::get('admin', 'Admin\AdminController@index');
Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);