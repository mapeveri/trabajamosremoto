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

// Authentication routes
Auth::routes();

// Main route
Route::get('/', 'HomeController@index')->name('home');

// For manage jobs
Route::resource('jobs', 'JobController')->except(['index', 'show']);
Route::get('jobs/{id}/{slug}', 'JobController@show')->name('jobs.show');


// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'Admin\AdminHomeController@index')->name('admin_home');
    Route::resource('users', 'Admin\UserController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('subcategories', 'Admin\SubCategoryController');
});
