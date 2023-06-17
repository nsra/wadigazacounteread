<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;
use Illuminate\Support\Facades\Auth;

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

Route::get('counter/delete/{id}', 'CounterController@delete')->name('delete')->middleware('auth');
Route::get('counter/update', 'CounterController@update_current_read')->name('counter.update')->middleware('auth');

Route::get('countersecond/delete/{id}', 'CountersecondController@delete')->name('countersecond.delete')->middleware('auth');
Route::get('countersecond/update', 'CountersecondController@update_current_read')->name('countersecond.update')->middleware('auth');

Route::get('counterthird/delete/{id}', 'CounterthirdController@delete')->name('counterthird.delete')->middleware('auth');
Route::get('counterthird/update', 'CounterthirdController@update_current_read')->name('counterthird.update')->middleware('auth');

Route::get('counterforth/delete/{id}', 'CounterforthController@delete')->name('counterforth.delete')->middleware('auth');
Route::get('counterforth/update', 'CounterforthController@update_current_read')->name('counterforth.update')->middleware('auth');

Route::resource('counters', 'CounterController')->middleware('auth');
Route::resource('counterseconds', 'CountersecondController')->middleware('auth');
Route::resource('counterthirds', 'CounterthirdController')->middleware('auth');
Route::resource('counterforths', 'CounterforthController')->middleware('auth');

Route::get('counter/refresh', 'CounterController@get_refresh')->name('refresh')->middleware('auth');
Route::get('refreshall', 'CounterController@refresh')->name('counters.refresh')->middleware('auth');

Route::get('countersecond/refresh', 'CountersecondController@get_refresh')->name('refreshsecond')->middleware('auth');
Route::get('refreshallsecond', 'CountersecondController@refresh')->name('counterseconds.refresh')->middleware('auth');

Route::get('counterthird/refresh', 'CounterthirdController@get_refresh')->name('refreshthird')->middleware('auth');
Route::get('refreshallthird', 'CounterthirdController@refresh')->name('counterthirds.refresh')->middleware('auth');

Route::get('counterforth/refresh', 'CounterforthController@get_refresh')->name('refreshforth')->middleware('auth');
Route::get('refreshallforth', 'CounterforthController@refresh')->name('counterforths.refresh')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('export-fothcounters', 'CounterController@export')->name('export_forthcounters');
Route::get('export-secondcounters', 'CountersecondController@export')->name('export_secondcounters');
Route::get('export-counters', 'CounterforthController@export')->name('export_counters');
Route::get('export-thirdcounters', 'CounterthirdController@export')->name('export_thirdcounters');



