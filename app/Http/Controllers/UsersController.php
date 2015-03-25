<?php namespace EAMES\Http\Controllers;

use EAMES\Http\Requests;
use EAMES\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EAMES\Models\User;
use EAMES\Models\Profile;
use EAMES\Models\Role;

class UsersController extends Controller {

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Preparation                                                                //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Define variables
   *
   * @var object
   */
  protected $user;

  /**
   * Class initialization.
   *
   * @return void
   */
  public function __construct(User $user) {

    // require authentication
    $this->middleware('auth');

    // create a new instance of user
    $this->user = $user;

  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Helpers                                                                    //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Save Record Helper
   *
   * @return void
   */
  protected function save_record($input, $id) {

    // unset password if blank
    if (empty($input['password'])) {
      unset($input['password']);
      unset($this->user->password);
    }

    // mod validation to exempt email and username from duplication with self
    User::$rules['username'] = 'required|min:3|unique:users,username,'.$id;
    User::$rules['email']    = 'required|email|unique:users,email,'.$id;

    // fill user object with the input data and validate
    if (!$this->user->fill($input)->isValid()) {
      return $this->user->messages;
    }

    // if root ensure role stays administrator
    if ($this->user->username == 'root') $this->user->role_id = Role::where('name', '=', 'Administrator')->firstOrFail()->id;

    // unset attributes that are not in the table
    unset($this->attributes['password_confirmation']);

    // has the password if it is set
    if (isset($input['password'])) $this->user->hashPassword($input['password']);

    // fill relationship data for associated tables
    $this->user->profile->first_name            = $input['profile']['first_name'];
    $this->user->profile->last_name             = $input['profile']['last_name'];
    $this->user->profile->title                 = $input['profile']['title'];
    $this->user->profile->phone_work_office     = $input['profile']['phone_work_office'];
    $this->user->profile->phone_work_mobile     = $input['profile']['phone_work_mobile'];
    $this->user->profile->phone_personal_home   = $input['profile']['phone_personal_home'];
    $this->user->profile->phone_personal_mobile = $input['profile']['phone_personal_mobile'];
    $this->user->profile->office_location       = $input['profile']['office_location'];
    $this->user->profile->notes                 = $input['profile']['notes'];

    // push to user and associated tables
    $this->user->push();

  }

  /**
   * Toggle user activation.
   *
   * @return Response
   */
  public function toggle_activation(Request $request) {

    // get the record to be modified
    $user = User::find($request->get('id'));

    // toggle the activation
    if ($user->active) {
      $user->active = 0;
      $status = 'deactivated';
    } else {
      $user->active = 1;
      $status = 'activated';
    }

    // update the record
    $user->save();

    // redirect back
    return redirect()->back()->with('alert', $user->username.' successfully '.$status);

  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // CRUD                                                                       //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() {

    // gather users
    $users = $this->user->with('role','profile')->get();

    // return view with the data
    return view('users.index', [
      'users' => $users
    ]);

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create() {

    // gather roles for dropdown
    $roles = Role::get()->lists('name','id');
    $managers = User::get()->lists('username','id');

    // add placeholder to beginning of array
    $managers = ['' => 'Select Manager'] + $managers;

    // return view with the data
    return view('users.create', array(
      'managers' => $managers,
      'roles'    => $roles
    ));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request) {

    // gather all posted input
    $input = $request->all();

    // fill the user object with the input data and validate
    if (!$this->user->fill($input)->isValid()) {
      return redirect()->back()->withInput()->withErrors($this->user->messages);
    }

    // hash the password
    $this->user->hashPassword($request->get('password'));

    // set them to inactive by default
    $this->user->active = 0;

    // save via push method as other tables are filled
    $this->user->push();

    // initialize a new profile record
    $profile = new Profile();
    $profile->first_name            = $input['profile']['first_name'];
    $profile->last_name             = $input['profile']['last_name'];
    $profile->title                 = $input['profile']['title'];
    $profile->manager_id            = $input['profile']['manager_id'];
    $profile->phone_work_office     = $input['profile']['phone_work_office'];
    $profile->phone_work_mobile     = $input['profile']['phone_work_mobile'];
    $profile->phone_personal_home   = $input['profile']['phone_personal_home'];
    $profile->phone_personal_mobile = $input['profile']['phone_personal_mobile'];
    $profile->office_location       = $input['profile']['office_location'];
    $profile->notes                 = $input['profile']['notes'];
    $this->user->profile()->save($profile);

    // redirect to the user index
    return redirect()->route('users.index')->with('alert', $this->user->username.' successfully created');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {

    // find the selected user
    $user = $this->user->whereId($id)->with('role', 'profile')->first();

    // return the view
    return view('users.show', [
      'user' => $user
    ]);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {

    // find the selected user
    $user     = $this->user->whereId($id)->with('profile')->first();
    $roles    = Role::get()->lists('name','id');
    $managers = User::get()->lists('username','id');

    // add placeholder to beginning of array
    $managers = ['' => 'Select Manager'] + $managers;

    // return view with the data
    return view('users.edit', [
      'user'     => $user,
      'roles'    => $roles,
      'managers' => $managers
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request) {

    // gather all posted input
    $input = $request->all();

    // fill user object with existing data
    $this->user = User::find($id);

    // save the record
    if ($errors = $this->save_record($input, $this->user->id)) {
      return redirect()->back()->withInput()->withErrors($errors);
    }

    // redirect to user index
    return redirect()->route('users.index')->with('alert', $this->user->username.' was successfuly updated');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {

    // get the records to be deleted
    $user    = User::find($id);
    $profile = Profile::find($user->profile->id);

    // deny if the root user account
    if ($user->username == 'root') return redirect()->back()->with('alert', 'the root account cannot be deleted');

    // delete user and associated profile
    $user->delete();
    $profile->delete();

    // redirect back to previous page
    return redirect()->back()->with('alert', $user->username.' was successfully deleted');

  }

}
