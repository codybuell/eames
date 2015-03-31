<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'licenses';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'software_id',
    'serial',
    'seats',
    'type',
    'term',
    'purchase_date',
    'price',
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
