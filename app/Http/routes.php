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

Route::get('admin/setting','Admin\SitesettingController@index'); 
    Route::post('admin/sitesetting/save_details','Admin\SitesettingController@save_details'); 
    Route::any('admin/sitesetting/uploadlogo','Admin\SitesettingController@uploadlogo');


    // Advance Custom Filds Section Routes
    Route::get('admin/advancesettings','Admin\AdvancesettingController@index'); 
    Route::post('admin/advancesettings/store','Admin\AdvancesettingController@store'); 
    Route::any('admin/advancesettings/getdata','Admin\AdvancesettingController@getdatatable')->name('advancesettings/getdata');; 
    Route::post('admin/advancesettings/delete','Admin\AdvancesettingController@destroy');
    Route::post('admin/advancesettings/edit','Admin\AdvancesettingController@edit');