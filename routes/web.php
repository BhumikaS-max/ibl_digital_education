<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::group(['prefix' => 'admin'], function(){
//    Route::post('logout', 'Auth\LoginController@logout')->name('admin-logout');
    Route::group(['prefix' => '/teacher'], function () {
        Route::get('/', 'TeacherController@index')->name('teacher.index');
        Route::post('/', 'TeacherController@store')->name('teacher.store');
        Route::post('/{id}/edit', 'TeacherController@edit')->name('teacher.edit');
        Route::delete('/{id}/delete', 'TeacherController@destroy')->name('teacher.destroy');
    });
//});

Route::get('/roles', 'PermissionController@Permission');

Route::group(['middleware' => 'role:teacher'], function() {
//    Route::group(['prefix' => 'user'], function() {
//        Route::post('logout', 'Auth\LoginController@logout')->name('admin-logout');
        return 'Welcome teacher';
//    });
});
Route::group(['middleware' => 'role:student'], function() {
//    Route::group(['prefix' => 'user'], function() {
//        Route::post('logout', 'Auth\LoginController@logout')->name('admin-logout');
        return 'Welcome student';
//    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
