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

Route::get('/home', 'HomeController@index')->name('home');

// User
Route::group(['prefix'=>'bills/chart', 'middleware'=>['auth']], function() {
   Route::get('fullDate', 'ChartController@fullDate')->name('fullDate');
    Route::get('tag', 'ChartController@tag')->name('tag');
});
Route::resource('bills', 'BillController');

// Admin
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('bills', 'BillController')->names([
        'index'=>'admin.bills.index',
        'show'=>'admin.bills.show',
        'destroy'=>'admin.bills.destroy',
        'update'=>'admin.bills.update',
        'edit'=>'admin.bills.edit',
    ])->except([
        'store',
        'create'
    ]);
    Route::get('users', 'UserController@index')->name('admin.users.index');
});

Route::get('debug', 'DebugController@index')->name('debug');

