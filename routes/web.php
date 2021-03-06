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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'admin.login']);
    Route::resource('/permission', 'PermissionController');
    Route::resource('/role', 'RoleController');
    Route::resource('/user', 'UserController');
    Route::resource('/article', 'Article\BaseController');
    Route::resource('/category', 'Article\CategoryController');
//    File Uploader
    Route::post('/upload/image', 'UploadController@image');
});
