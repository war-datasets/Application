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

Auth::routes();

Route::get('/', 'indexController@index')->name('home.front');
Route::get('/home', 'HomeController@index')->name('home.backoend');

Route::resource('casualties', 'CasualtyController');
Route::get('search', 'CasualtyController@search')->name('casualty.search');

Route::get('disclaimer', 'DisclaimerController@index')->name('disclaimer');

Route::get('account/settings', 'AccountSettingsController@index')->name('account.settings');

Route::get('news/index', 'NewsController@index')->name('news.index');

Route::get('helpdesk', 'HelpdeskController@index')->name('helpdesk.index');
Route::get('helpdesk/admin', 'HelpdeskController@admin')->name('helpdesk.admin');