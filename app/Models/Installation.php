<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'installations';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'hardware_id',
    'software_id',
    'license_id',
    'version',
    'patch',
    'notes',
    'performed_by',
    'performed_at',
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
