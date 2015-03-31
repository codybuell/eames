<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'hardwares';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'owner_id',
    'user_id',
    'admin_id',
    'team_id',
    'status',
    'name',
    'location',
    'type',
    'make',
    'model',
    'asset_tag',
    'serial',
    'notes',
    'created_by',
    'updated_by'
  ];

  /**
   * Define relationship with logs model.
   *
   * @return Log
   */
  public function logs() {
    return $this->hasMany('EAMES\Models\Log');
  }

}
