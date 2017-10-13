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
Route::post('/home/cancel', 'HomeController@cancel')->name('cancel');
Route::get('/home/enroll', 'HomeController@enroll')->name('enroll');
Route::get('/home/create-plan', 'HomeController@createSubscriptionPlan')->name('create_sub_plan');

Route::get('/home/kba', 'KbaController@index')->name('kba');

// Static Pages
  Route::get('terms', function () {
    return view('pages.terms');
  });
  Route::get('privacy', function () {
    return view('pages.privacy');
  });

// Admin Dashboard routes
Route::group(['middleware' => 'can:accessAdminDashboard'], function() {
    Route::get('admin', 'Admin\AdminController@index')->name('dashboard');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::post('admin/cancel-user', 'Admin\UsersController@cancelUser')->name('cancel_user');
    //Route::resource('admin/charges', 'Admin\ChargesController');
    //Route::resource('admin/subscriptions', 'Admin\SubscriptionsController');
});