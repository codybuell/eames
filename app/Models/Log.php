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
    'title',
    'content',
    'system'
  ];

  // field validation rules
  public static $rules = [
    'title'   => 'required|max:50',
    'system'  => 'max:50',
    'content' => ''
  ];

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Relationships                                                              //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public function user() {
    return $this->belongsTo('User');
  }

  public function profile() {
    return $this->hasOne('Profile', 'user_id', 'user_id');
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
