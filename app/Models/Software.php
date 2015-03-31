<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'softwares';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'make',
    'model',
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
