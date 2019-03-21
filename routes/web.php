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

// Id Only numeric
Route::pattern('id', '\d+');
// Slug characters valid
Route::pattern('slug', '[a-z0-9-]+');

// Authentication routes
Auth::routes();

// Main route
Route::get('/', 'HomeController@index')->name('home');

// For manage jobs
Route::resource('jobs', 'JobController')->except(['index', 'show']);
Route::get('jobs/{id}/{slug}', 'JobController@show')->name('jobs.show');
Route::get('jobs/category/{id}/{slug}', 'JobController@showCategory')->name('jobs.show_category');
Route::get('jobs/category/{id}/{slug}/{subcategory_id}/{subcategory_slug}', 'JobController@showSubCategory')->name('jobs.show_subcategory');

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'Admin\AdminHomeController@index')->name('admin_home');
    Route::resource('users', 'Admin\UserController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('subcategories', 'Admin\SubCategoryController');
});
