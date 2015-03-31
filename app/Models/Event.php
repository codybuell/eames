<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'events';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'calendar',
    'title',
    'location',
    'notes',
    'all_day',
    'event_start',
    'event_end',
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
