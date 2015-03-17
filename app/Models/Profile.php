<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'profiles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'manager_id',
    'photo',
    'first_name',
    'last_name',
    'title',
    'phone_work_office',
    'phone_work_mobile',
    'phone_personal_home',
    'phone_personal_mobile',
    'office_location',
    'notes',
    'created_by',
    'updated_by'
  ];

  /**
   * Define reverse one to one relationship with user model.
   *
   * @return User
   */
  public function user() {
    return $this->belongsTo('User');
  }

}
