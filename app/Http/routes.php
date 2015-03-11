<?php

/*
|--------------------------------------------------------------------------
| Unauthenticated Routes
|--------------------------------------------------------------------------
|
| Routes that are available to all users without loggin in to the application.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes that require users to be logged in to access.
|
*/

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Routes for handling login, logout and password resets.  Order here is
| critical, these need to be at the end of this routes file and
| Auth\AuthController must be the last route listed.
|
*/

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::controllers([
  'password' => 'Auth\PasswordController',
  '/'        => 'Auth\AuthController',
]);
