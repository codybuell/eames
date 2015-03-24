<?php namespace EAMES\Http\Controllers\Auth;

use Carbon\Carbon;
use EAMES\Models\User;
use EAMES\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

  /*
  |--------------------------------------------------------------------------
  | Overrides
  |--------------------------------------------------------------------------
  |
  | Override default redirect location from `home` to `admin` and login url
  | from auth/login to login.
  |
  */

  protected $loginPath    = '/login';
  protected $redirectPath = '/admin';

  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers;

  /*
  | Create a new authentication controller instance.
  |
  | @param  \Illuminate\Contracts\Auth\Guard  $auth
  | @param  \Illuminate\Contracts\Auth\Registrar  $registrar
  | @return void
  */

  public function __construct(Guard $auth, Registrar $registrar)
  {
    $this->auth = $auth;
    $this->registrar = $registrar;

    $this->middleware('guest', ['except' => 'getLogout']);
  }

  /**
   * Override a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postLogin(Guard $auth, Request $request) {

    // require username/email and password
    $this->validate($request, [
      'login'    => 'required',
      'password' => 'required',
    ]);

    // determine if username or email was used
    $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $request->merge([$field => $request->input('login')]);

    // check auth and redirect
    if ($this->auth->attempt($request->only($field, 'password'))) {

      // identify the user
      $user = User::find($auth->user()->id);

      // active account check
      if (!$user->active) {
        $auth->logout();
        return redirect($this->loginPath())->withErrors('Your account has not been activated.');
      }

      // update login_count
      $user->login_count++;

      // update last_login time
      $user->last_login = Carbon::now();
      $user->save();

      // redirect to intended destination
      return redirect()->intended($this->redirectPath());
    }

    // auth failure handling
    return redirect($this->loginPath())
          ->withInput($request->only('login', 'remember'))
          ->withErrors([
            'login' => $this->getFailedLoginMessage(),
          ]);
  }

}
