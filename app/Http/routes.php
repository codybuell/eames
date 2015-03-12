<?php

/*
|--------------------------------------------------------------------------
| Unauthenticated Routes
|--------------------------------------------------------------------------
|
| Routes that are available to all users without loggin in to the application.
|
*/

Route::get('/', function() {
  if (Auth::check()) {
    return Redirect::to('dashboard');
  } else {
    return Redirect::to('login');
  }
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes that require users to be logged in to access.
|
*/

Route::group(['middleware' => 'auth'], function() {

  Route::get('dashboard', function() {
    return 'dashboard';
  });

});

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
