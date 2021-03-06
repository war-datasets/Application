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

Route::resource('casualties', 'CasualtyController');
Route::get('search', 'CasualtyController@search')->name('casualty.search');

Route::get('disclaimer', 'DisclaimerController@index')->name('disclaimer');

// Account settings routes
Route::get('account/settings', 'AccountSettingsController@index')->name('account.settings');
Route::post('account/update/security', 'AccountSettingsController@updateSecurity')->name('account.settings.security');
Route::post('account/update/settings', 'AccountSettingsController@updateInfo')->name('account.settings.info');

// API key routes
Route::post('api/key/create', 'AccountSettingsController@createAPiKey')->name('api.key.create');
Route::get('api/key/delete/{id}', 'AccountSettingsController@deleteApiKey')->name('api.key.delete');

Route::get('news/index', 'NewsController@index')->name('news.index');

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');
Route::get('/users/search', 'UsersController@search')->name('users.search');
Route::get('/users/json/{id}', 'UsersController@userJson')->name('user.json');
Route::post('/users/block', 'UsersController@block')->name('user.block');
Route::get('/users/unblock/{id}', 'usersController@unblock')->name('user.unblock');

// Permissions routes
Route::get('/permissions', 'PermissionController@index')->name('permissions.index');

// Role routes
Route::get('/roles', 'RoleController@index')->name('roles.index');
Route::get('/roles/delete/{id}', 'RoleController@delete')->name('roles.delete');
Route::post('/role/store', 'RoleController@store')->name('roles.create');

Route::get('helpdesk', 'HelpdeskController@index')->name('helpdesk.index');
Route::get('helpdesk/create', 'HelpdeskController@create')->name('helpdesk.create');
Route::get('helpdesk/admin', 'HelpdeskController@admin')->name('helpdesk.admin');
ROute::post('helpdesk/store', 'HelpdeskController@store')->name('helpdesk.store');
Route::get('helpdesk/ticket/{id}', 'HelpdeskController@show')->name('helpdesk.show');
Route::get('helpdesk/gebruiker', 'HelpdeskController@questionUser')->name('helpdesk.user');