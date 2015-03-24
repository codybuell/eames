<?php namespace EAMES\Http\Controllers;

use EAMES\Http\Requests;
use EAMES\Http\Controllers\Controller;

use Illuminate\Http\Request;

use EAMES\Models\User;

class UsersController extends Controller {

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

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() {

    // gather users
    $users = $this->user->with('role','profile')->get();

    // return view with the data
    return view('users.index', array(
      'users' => $users
    ));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}
