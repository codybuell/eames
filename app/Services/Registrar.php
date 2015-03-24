<?php namespace EAMES\Services;

use EAMES\Models\User;
use EAMES\Models\Role;
use EAMES\Models\Profile;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  public function validator(array $data)
  {
    return Validator::make($data, [
      'username'   => 'required|max:255',
      'first_name' => 'required|max:255',
      'last_name'  => 'required|max:255',
      'email'      => 'required|email|max:255|unique:users',
      'password'   => 'required|confirmed|min:6',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
  public function create(array $data)
  {

    // define user, default read only and inactive
    $user = new User([
      'username' => $data['username'],
      'email'    => $data['email'],
      'password' => bcrypt($data['password']),
      'role_id'  => Role::where('name', '=', 'Read Only')->firstOrFail()->id,
      'active'   => 0
    ]);

    // define associated profile
    $profile = new Profile([
      'first_name' => $data['first_name'],
      'last_name'  => $data['last_name']
    ]);

    // save user record
    $user->save();

    // save associated profile
    $profile = $user->profile()->save($profile);

    // return user
    return $user;

  }

}
