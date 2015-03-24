<?php namespace EAMES\Http\Middleware;

use Closure;
use EAMES\Models\User;
use Illuminate\Contracts\Auth\Guard;

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
        $this->auth->logout();
        return redirect('/login')->withErrors('Your account has not been activated.');
      }
    }

    return $next($request);

  }

}
