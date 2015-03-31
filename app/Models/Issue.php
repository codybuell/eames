<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'issues';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'assigned_id',
    'hardware_id',
    'software_id',
    'installation_id',
    'title',
    'event_time',
    'status',
    'event',
    'problem',
    'solution',
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
