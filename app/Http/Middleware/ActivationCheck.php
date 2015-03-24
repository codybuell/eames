<?php namespace EAMES\Http\Middleware;

use Closure;
use EAMES\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;

class ActivationCheck {

  protected $auth;
  protected $user;

  public function __construct(Guard $auth) {

    $this->auth = $auth;

    if ($this->auth->check()) {
      // identify the user
      $this->user = User::find($auth->user()->id);
    }

  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {

    // active account check
    if ($this->auth->check()) {
      if (!$this->user->active) {

        $created = new Carbon($this->user->created_at);
        $now     = Carbon::now();

        // logout the user
        $this->auth->logout();

        if ($created->addSeconds(2)->gt($now)) {
          // if regestered within the last two seconds display registration notification
          return redirect('/login')->withAlert('Your account has been registered and is awaiting activation.');
        } else {
          // else show error for inactive account
          return redirect('/login')->withErrors('Your account has not been activated.');
        }

      }
    }

    return $next($request);

  }

}
