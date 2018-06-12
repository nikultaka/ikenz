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
Route::get('/', function () {
    return view('login');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/logo', function () {
    return view('admin.logo_upload');
});
Route::get('/home/login', function () {
    return view('login');
});
Route::get('/home/register', function () {
    return view('register');
});
Route::get('/dashboard','HomeController@index');
Route::auth();

Route::get('/home', 'DashboardController@index');
Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('/home/login');
});



//This is for admin

Route::get('testimonial', 'Admin\TestimonialController@index');
Route::any('testimonial/addrecord', 'Admin\TestimonialController@addrecord');
Route::any('testimonial/getdata', 'Admin\TestimonialController@anydata')->name('testimonial/getdata');
Route::any('testimonial/delete', 'Admin\TestimonialController@deleterecord');

Route::group(['prefix' => 'admin'], function()
{
    Route::get('/', function(){
        return view('admin.login');
    });
    Route::post('/login', 'Admin\AdminController@admin');
    Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('/admin/');
    });
    
    
    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::any('/dashboard', 'Admin\DashboardController@index');
    });
});

    // Authentication Routes...
//    $this->get('login', 'Auth\AuthController@showLoginForm');
//    $this->post('login', 'Auth\AuthController@login');
//    $this->get('logout', 'Auth\AuthController@logout');
//    // Registration Routes...
//    $this->get('register', 'Auth\AuthController@showRegistrationForm');
//    $this->post('register', 'Auth\AuthController@register');
//    // Password Reset Routes...
//    $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
//    $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
//    $this->post('password/reset', 'Auth\PasswordController@reset');

//Setting Section Filds Section


Route::get('/setting','SitesettingController@index'); 
Route::post('/sitesetting/save_details','SitesettingController@save_details'); 
Route::any('sitesetting/uploadlogo','SitesettingController@uploadlogo');


// Advance Custom Filds Section Routes
Route::get('/advancesettings','AdvancesettingController@index'); 
Route::post('advancesettings/store','AdvancesettingController@store'); 
Route::any('advancesettings/getdata','AdvancesettingController@getdatatable')->name('advancesettings/getdata');; 
Route::post('advancesettings/delete','AdvancesettingController@destroy');
Route::post('advancesettings/edit','AdvancesettingController@edit');