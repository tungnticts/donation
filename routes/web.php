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

Route::get('/', 'HomeController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/projects', 'ProjectController@index')->name('project.list');
Route::get('/projects/{id}', 'ProjectController@detail')->name('project.detail');

Route::get('checkout', 'CartController@check_out')->name('cart.check_out');
Route::get('pay_to_vtc', 'CartController@pay_to_vtc')->name('cart.process');

Route::prefix('admin')->group(function () {
    Route::get('/products', 'ProductController@admin_product_list')->name('product.product_list')->middleware('auth');
    Route::get('/products/create/', 'ProductController@admin_create_product')->name('product.create')->middleware('auth');
    Route::get('/products/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth');
    Route::post('/products/store', 'ProductController@admin_store')->name('product.store')->middleware('auth');
    Route::get('/products/delete/{id}', 'ProductController@delete')->name('product.delete')->middleware('auth');
    Route::post('/products/save_edit', 'ProductController@save_edit')->name('product.save_id')->middleware('auth');
    Route::get('/items', 'ProductController@admin_items')->name('product.items')->middleware('auth');

    Route::get('/categories', 'CategoryController@admin_list')->name('category.admin_list')->middleware('auth');
    Route::get('/categories/create', 'CategoryController@create')->name('category.create')->middleware('auth');
    Route::post('/categories/store', 'CategoryController@store')->name('category.store')->middleware('auth');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('category.edit')->middleware('auth');
    Route::post('/categories/store_edit', 'CategoryController@store_edit')->name('category.store_edit')->middleware('auth');
});