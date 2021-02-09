<?php

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

Route::get('/','App\http\Controllers\BreatheController@index');

Route::resource('breathe', 'App\http\Controllers\BreatheController');

Route::post('update/stop', 'App\http\Controllers\BreatheController@updateStop');

Route::post('update/start', 'App\http\Controllers\BreatheController@updateStart');
Route::get('brethe/end', 'App\http\Controllers\BreatheController@end')->name('end');


