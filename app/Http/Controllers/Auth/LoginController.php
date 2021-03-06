<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    public function redirectTo()
    {
        if (!Auth::check()) {
            $this->redirectTo = '/login';
            return $this->redirectTo;
        }

        if (auth()->user()->admin == 1) {


            $this->redirectTo = '/admin_dash_board';
            return $this->redirectTo;
        }

        if (auth()->user()->admin == 0  && auth()->user()->print_vendor == 1) {
            $this->redirectTo = '/print_vendor_dashboard';
            return $this->redirectTo;
        }

        if (auth()->user()->admin == 0  && auth()->user()->delivery_vendor == 1) {
            $this->redirectTo = '/delivery_vendor_dashboard';
            return $this->redirectTo;
        }
        $this->redirectTo = '/user_dashboard';
        return $this->redirectTo;



        // return $next($request);
    }
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if(is_numeric($request->input('email')))
        {
            $user = User::wherePhone($request->input('email'))
                ->wherePassword($request->input('password'))
                ->first();
        }else{
            $user = User::whereEmail($request->input('email'))
                ->wherePassword($request->input('password'))
                ->first();
        }

        if ($user !== null) {
            Auth::login($user);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
