<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'projects';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'assigned_id',
    'priority',
    'due_date',
    'status',
    'title',
    'notes',
    'prerequisites',
    'started_at',
    'started_by',
    'completed_at',
    'completed_by',
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
