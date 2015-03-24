<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'roles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'class',
    'created_by',
    'updated_by',
    'ping'
  ];

  /**
   * Define relationship with user model.
   *
   * @return User
   */
  public function users() {
    return $this->hasMany('User');
  }

}
