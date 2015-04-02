<?php namespace EAMES\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Preparation                                                                //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  // allowed for mass assignment
  protected $fillable = [
    'type',
    'hardware_id',
    'software_id',
    'license_id',
    'installation_id',
    'maintenance_id',
    'project_id',
    'task_id',
    'issue_id',
    'event_id',
    'title',
    'notes',
    'datetime',
    'created_by',
    'updated_by'
  ];

  // field validation rules
  public static $rules = [
    'title'    => 'required|max:50',
    'type'     => 'required',
    'datetime' => 'required|date_format:Y-m-d H:i:s'
    //'datetime' => 'required|date_format:Y-m-d H:i:s O'  // timezone, table and js must support
  ];

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Relationships                                                              //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public function user() {
    return $this->belongsTo('EAMES\Models\User');
  }

  public function creator() {
    return $this->hasOne('EAMES\Models\Profile', 'user_id', 'created_by');
  }

  public function updator() {
    return $this->hasOne('EAMES\Models\Profile', 'user_id', 'updated_by');
  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Search                                                                     //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public static function search($keyword) {
    $finder = Log::orWhere('type', 'LIKE', "%{$keyword}%")
                 ->orWhere('title', 'LIKE', "%{$keyword}%")
                 ->orWhere('system', 'LIKE', "%{$keyword}%")
                 ->orWhere('content', 'LIKE', "%{$keyword}%")
                 ->orderBy('created_at', 'desc')
                 ->with('user','profile')
                 ->paginate(50);

    return $finder;
  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Validator                                                                  //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public function isValid() {

    // validate filled attributes
    $validation = \Validator::make($this->attributes, static::$rules);

    // if validation passes
    if ($validation->passes()) {
      return true;
    }

    // fill messages if validation fails
    $this->messages = $validation->messages();

    return false;

  }

}
