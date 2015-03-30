<?php namespace EAMES\Http\Controllers;

use EAMES\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use EAMES\Models\Log;
use Markdown;

class LogsController extends Controller {

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
  protected $log;
  protected $types;

  /**
   * Class initialization.
   *
   * @return void
   */
  public function __construct(Log $log) {

    // require user level access for all except defined methods
//  $this->beforeFilter('user', ['except' => [
//    'search',
//    'index',
//    'show'
//  ]]);

    // create a new instance of log
    $this->log = $log;

    // require manager level access for all except defined methods
//  $this->beforeFilter('manager', ['except' => [
//    'index',
//    'create',
//    'store',
//    'show',
//    'edit',
//    'update'
//  ]]);

    // define log types
    $this->types = [
      ''               => 'Select Log Type',
      'I&T Activity'   => 'I&T Activity',
      'Administration' => 'Administration'
    ];

  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // Helpers                                                                    //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  /**
   * Search
   *
   * @return Response
   */
  public function search($string) {

    // query the string
    $logs = Log::search(urldecode($string));

    // determine if ajax was used for the request
    if (Request::ajax()) {
      $view = '_partials.logs_list_table';
    } else {
      $view = 'logs.index';
    }

    // return view with the data
    return view($view, [
      'logs' => $logs
    ]);

  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // CRUD                                                                       //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public function index() {

    // gather all the log logs
    $logs = $this->log->with('user','profile')->orderBy('created_at', 'desc')->paginate(50);

    // return view with the data
    return view('logs.index', [
      'logs' => $logs
    ]);

  }

  public function create() {

    // return creation view
    return view('logs.create', [
      'types' => $this->types
    ]);

  }

  public function store(Request $request, Guard $auth) {

    // gather all posted input
    $input = $request->all();

    // fill the log object with the input data and validate
    if (!$this->log->fill($input)->isValid()) {
      return Redirect::back()->withInput()->withErrors($this->log->messages);
    }

    // tag the log with the users id
    $this->log->user_id = $auth->user()->id;

    // save via push method as other tables are filled
    $this->log->push();

    // redirect to the log index
    return Redirect::route('logs.index')->with('alert', 'log successfully created');

  }

  public function show($id) {

    // get the log
    $log = $this->log->find($id);

    // generate markdown
    $content = Markdown::render($log->content);

    // return show view
    return view('logs.show', [
      'title'   => $log->title,
      'content' => $content
    ]);

  }

  public function edit($id) {

    // get the log
    $log = $this->log->find($id);

    // return show view
    return view('logs.edit', [
      'log'   => $log,
      'types' => $this->types
    ]);

  }

  public function update($id, Request $request) {

    // gather all posted input
    $input = $request->all();

    // fill user object with existing data
    $this->log = Log::find($id);

    // fill user object with the input data and validate
    if (!$this->log->fill($input)->isValid()) {
      return $this->log->messages;
    }

    // push to user and associated tables
    $this->log->push();

    // redirect to user index
    return Redirect::route('logs.index')->with('alert', 'log record successfuly updated');

  }

  public function destroy($id) {

    // get the record to be deleted
    $log = Log::find($id);

    // delete user and associated profile
    $log->delete();

    // redirect back to previous page
    return Redirect::back()->with('alert', 'record successfully deleted');

  }

}
