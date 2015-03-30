<?php namespace EAMES\Models;

use Validator;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

  use Authenticatable, CanResetPassword;

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Variables                                                                  //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['role_id', 'active', 'username', 'email', 'password', 'password_confirmation'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * Field validation parameters.
   *
   * @var array
   */
  public static $rules = [
    'username' => 'required|unique:users|min:3',
    'email'    => 'required|unique:users|email',
    'password' => 'sometimes|required|confirmed|min:6',
  ];

  /**
   * Validation messages container.
   *
   * @var string
   */
  public $messages;

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Relationships                                                              //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Define relationship with profile model.
   *
   * @return Profile
   */
  public function profile() {
    return $this->hasOne('EAMES\Models\Profile');
  }

  /**
   * Define relationship with role model.
   *
   * @return Role
   */
  public function role() {
    return $this->belongsTo('EAMES\Models\Role');
  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Helper Methods                                                             //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Validate users.
   *
   * @param array $data
   * @return bool
   */
  public function isValid() {

    // validate filled attributes
    $validation = Validator::make($this->attributes, static::$rules);

    // if validation passes
    if ($validation->passes()) {
      // unset attributes that are not in the table
      unset($this->attributes['password_confirmation']);

      return true;
    }

    // fill messages if validation fails
    $this->messages = $validation->messages();

    return false;

  }

  /**
   * Hash the password.
   *
   * @param string $value
   * @return void
   */
  public function hashPassword($value) {
    $this->attributes['password'] = bcrypt($value);
  }
}
