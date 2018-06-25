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
    
    
//    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::any('/dashboard', 'Admin\DashboardController@index');
        
        Route::get('cms', 'Admin\CmsController@index');
        Route::get('cms/add', 'Admin\CmsController@add');
        
        Route::get('media', 'Admin\MediaController@index');
        Route::get('media/add', 'Admin\MediaController@add');
        Route::any('media/get_category_data', 'Admin\MediaController@get_category_data');
        
<<<<<<< HEAD
        Route::get('upload-media', 'Admin\UploadmediaController@index');
         Route::any('upload-media/upload', 'Admin\UploadmediaController@upload');
        
    });
    
    
});
=======
>>>>>>> 18e24354e8c7bab519011818a1586eba8e536968

    Route::get('testimonial', 'Admin\TestimonialController@index');
    Route::any('testimonial/addrecord', 'Admin\TestimonialController@addrecord');
    Route::any('testimonial/getdata', 'Admin\TestimonialController@anydata')->name('testimonial/getdata');
    Route::any('testimonial/delete', 'Admin\TestimonialController@deleterecord');
    Route::any('testimonial/edit', 'Admin\TestimonialController@edittestimonial');

    Route::get('faq', 'Admin\FaqController@index');
    Route::any('faq/addrecord', 'Admin\FaqController@addrecord');
    Route::any('faq/getdata', 'Admin\FaqController@anydata')->name('faq/getdata');
    Route::any('faq/delete', 'Admin\FaqController@deleterecord');
    Route::any('faq/edit', 'Admin\FaqController@editfaq');

    Route::get('faq_category', 'Admin\FaqcategoryController@index');
    Route::any('faq_category/addrecord', 'Admin\FaqcategoryController@addrecord');
    Route::any('faq_category/getdata', 'Admin\FaqcategoryController@anydata')->name('faq_category/getdata');
    Route::any('faq_category/delete', 'Admin\FaqcategoryController@deleterecord');
    Route::any('faq_category/edit', 'Admin\FaqcategoryController@editfaq_category');
    
    Route::get('contact_us', 'Admin\Contact_usController@index');
    Route::any('contact_us/addrecord', 'Admin\Contact_usController@addrecord');
    Route::any('contact_us/getdata', 'Admin\Contact_usController@anydata')->name('contact_us/getdata');
    Route::any('contact_us/delete', 'Admin\Contact_usController@deleterecord');
    Route::any('contact_us/edit', 'Admin\Contact_usController@editcontact_us');
    Route::any('contact_us/email', 'Admin\Contact_usController@email_reply');
    
    
    Route::get('newsletter', 'Admin\NewsletterController@index');
    Route::any('newsletter/getdata', 'Admin\NewsletterController@anydata')->name('news_latter/getdata');
    Route::any('newsletter/delete', 'Admin\NewsletterController@deleterecord');
    
    
    Route::get('user', 'Admin\UserController@index');
    Route::any('user/addrecord', 'Admin\UserController@addrecord');
    Route::any('user/getdata', 'Admin\UserController@anydata')->name('contact_us/getdata');
    Route::any('user/delete', 'Admin\UserController@deleterecord');
    Route::any('user/edit', 'Admin\UserController@edituser');
    Route::any('user/email', 'Admin\UserController@check_email');
    
    
    Route::get('user_role', 'Admin\User_roleController@index');
    Route::any('user_role/addrecord', 'Admin\User_roleController@addrecord');
    Route::any('user_role/getdata', 'Admin\User_roleController@anydata')->name('contact_us/getdata');
    Route::any('user_role/delete', 'Admin\User_roleController@deleterecord');
    Route::any('user_role/edit', 'Admin\User_roleController@edit_user_role');
//    Route::any('admin/user_role/email', 'Admin\User_roleController@check_email');
    
    
    
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

    Route::get('setting','Admin\SitesettingController@index'); 
    Route::post('sitesetting/save_details','Admin\SitesettingController@save_details'); 
    Route::any('sitesetting/uploadlogo','Admin\SitesettingController@uploadlogo');


// Advance Custom Filds Section Routes
Route::get('advancesettings','admin\AdvancesettingController@index'); 
Route::post('advancesettings/store','admin\AdvancesettingController@store'); 
Route::any('advancesettings/getdata','admin\AdvancesettingController@getdatatable')->name('advancesettings/getdata');; 
Route::post('advancesettings/delete','admin\AdvancesettingController@destroy');
Route::post('advancesettings/edit','admin\AdvancesettingController@edit');

});