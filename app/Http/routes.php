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



Route::group(['prefix' => 'admin'], function()
{
    Route::get('/', function(){
        return view('admin.login');
    });
    
    Route::get('/login', function(){

        return view('admin.login');
    });
    Route::post('/login', 'Admin\AdminController@admin');
    Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('/admin/');
        
        
    });
    
    
    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::any('/dashboard', 'Admin\DashboardController@index');
        
        Route::get('cms', 'Admin\CmsController@index');
        Route::get('cms/add', 'Admin\CmsController@add');
        
        Route::get('media', 'Admin\MediaController@index');
        Route::get('media/add', 'Admin\MediaController@add');
        Route::any('media/get_category_data', 'Admin\MediaController@get_category_data');
        
    });
    
    
});

    Route::get('admin/testimonial', 'Admin\TestimonialController@index');
    Route::any('admin/testimonial/addrecord', 'Admin\TestimonialController@addrecord');
    Route::any('admin/testimonial/getdata', 'Admin\TestimonialController@anydata')->name('testimonial/getdata');
    Route::any('admin/testimonial/delete', 'Admin\TestimonialController@deleterecord');
    Route::any('admin/testimonial/edit', 'Admin\TestimonialController@edittestimonial');

    Route::get('admin/faq', 'Admin\FaqController@index');
    Route::any('admin/faq/addrecord', 'Admin\FaqController@addrecord');
    Route::any('admin/faq/getdata', 'Admin\FaqController@anydata')->name('faq/getdata');
    Route::any('admin/faq/delete', 'Admin\FaqController@deleterecord');
    Route::any('admin/faq/edit', 'Admin\FaqController@editfaq');

    Route::get('admin/faq_category', 'Admin\FaqcategoryController@index');
    Route::any('admin/faq_category/addrecord', 'Admin\FaqcategoryController@addrecord');
    Route::any('admin/faq_category/getdata', 'Admin\FaqcategoryController@anydata')->name('faq_category/getdata');
    Route::any('admin/faq_category/delete', 'Admin\FaqcategoryController@deleterecord');
    Route::any('admin/faq_category/edit', 'Admin\FaqcategoryController@editfaq_category');
    
    Route::get('admin/contact_us', 'Admin\Contact_usController@index');
    Route::any('admin/contact_us/addrecord', 'Admin\Contact_usController@addrecord');
    Route::any('admin/contact_us/getdata', 'Admin\Contact_usController@anydata')->name('contact_us/getdata');
    Route::any('admin/contact_us/delete', 'Admin\Contact_usController@deleterecord');
    Route::any('admin/contact_us/edit', 'Admin\Contact_usController@editcontact_us');
    Route::any('admin/contact_us/email', 'Admin\Contact_usController@email_reply');
    
    
    
    
    
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
Route::get('admin/advancesettings','admin\AdvancesettingController@index'); 
Route::post('advancesettings/store','AdvancesettingController@store'); 
Route::any('admin/advancesettings/getdata','admin\AdvancesettingController@getdatatable')->name('advancesettings/getdata');; 
Route::post('advancesettings/delete','AdvancesettingController@destroy');
Route::post('advancesettings/edit','AdvancesettingController@edit');
