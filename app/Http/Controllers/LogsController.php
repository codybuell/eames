<?php namespace EAMES\Http\Controllers;

use EAMES\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use EAMES\Models\Log;
use EAMES\Models\Hardware;
use EAMES\Models\Software;
use EAMES\Models\License;
use EAMES\Models\Installation;
use EAMES\Models\Maintenance;
use EAMES\Models\Project;
use EAMES\Models\Task;
use EAMES\Models\Issue;
use EAMES\Models\Event;
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
  protected $assoc;
  protected $related;

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
      'Administration' => 'Administration',
      'Maintenance'    => 'Maintenance',
    ];

    // define log associations
    $this->assoc = [
      'log_placeholder'  => 'Associations...',
      'log_hardware'     => 'Hardware',
      'log_software'     => 'Software',
      'log_license'      => 'License',
      'log_installation' => 'Installation',
      'log_project'      => 'Project',
      'log_task'         => 'Task',
      'log_issue'        => 'Issue',
      'log_event'        => 'Event',
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

  /**
   * Grab Related Records
   *
   * @return Void
   */
  private function getRelated() {
    // build arrays
    $this->related['hardwares']     = Hardware::get()->lists('name','id');
    $this->related['softwares']     = Software::get()->lists('name','id');
    $this->related['licenses']      = License::get()->lists('id','id');
    $this->related['installations'] = Installation::get()->lists('id','id');
    $this->related['projects']      = Project::get()->lists('title','id');
    $this->related['tasks']         = Task::get()->lists('title','id');
    $this->related['issues']        = Issue::get()->lists('title','id');
    $this->related['events']        = Event::get()->lists('title','id');

    // add placeholder to beginning of arrays
    $this->related['hardwares']     = ['' => 'Select Hardware'] + $this->related['hardwares'];
    $this->related['softwares']     = ['' => 'Select Software'] + $this->related['softwares'];
    $this->related['licenses']      = ['' => 'Select License'] + $this->related['licenses'];
    $this->related['installations'] = ['' => 'Select Installation'] + $this->related['installations'];
    $this->related['projects']      = ['' => 'Select Project'] + $this->related['projects'];
    $this->related['tasks']         = ['' => 'Select Task'] + $this->related['tasks'];
    $this->related['issues']        = ['' => 'Select Issue'] + $this->related['issues'];
    $this->related['events']        = ['' => 'Select Event'] + $this->related['events'];
  }

  ////////////////////////////////////////////////////////////////////////////////
  //                                                                            //
  // CRUD                                                                       //
  //                                                                            //
  ////////////////////////////////////////////////////////////////////////////////

  public function index() {

    // gather all the log logs
    $logs = $this->log->with('user','creator')->orderBy('created_at', 'desc')->paginate(50);

    // return view with the data
    return view('logs.index', [
      'logs' => $logs
    ]);

  }

  public function create() {

    // update related lists
    $this->getRelated();

    // return creation view
    return view('logs.create', [
      'types'   => $this->types,
      'assoc'   => $this->assoc,
      'related' => $this->related
    ]);

  }

  public function store(Request $request, Guard $auth) {

    // gather all posted input
    $input = $request->all();

    // fill the log object with the input data and validate
    if (!$this->log->fill($input)->isValid()) {
      return redirect()->back()->withInput()->withErrors($this->log->messages);
    }

    // tag the log with the users id
    $this->log->created_by = $auth->user()->id;

    // save via push method as other tables are filled
    $this->log->push();

    // redirect to the log index
    return redirect()->route('logs.index')->with('alert', 'log successfully created');

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
    return redirect()->route('logs.index')->with('alert', 'log record successfuly updated');

  }

  public function destroy($id) {

    // get the record to be deleted
    $log = Log::find($id);

    // delete user and associated profile
    $log->delete();

    // redirect back to previous page
    return redirect()->back()->with('alert', 'record successfully deleted');

  }

}
