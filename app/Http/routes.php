<?php

/*
|--------------------------------------------------------------------------
| Unauthenticated Routes
|--------------------------------------------------------------------------
|
| Routes that are available to all users without loggin in to the application.
|
*/

Route::get('/', ['as' => 'home', function() {
  if (Auth::check()) {
    return Redirect::to('dashboard');
  } else {
    return Redirect::to('login');
  }
}]);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes that require users to be logged in to access.
|
*/

Route::group(['middleware' => 'auth'], function() {

  // dashboard
  Route::get('dashboard', ['as' => 'dashboard', function() {
    return 'dashboard';
  }]);

  // users
  Route::resource('users', 'UsersController');
  Route::get('account',   ['as' => 'account',        'uses' => 'UsersController@account']);
  Route::put('account',   ['as' => 'account.update', 'uses' => 'UsersController@account_update']);
  Route::post('activate', ['as' => 'users.activate', 'uses' => 'UsersController@toggle_activation']);

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
