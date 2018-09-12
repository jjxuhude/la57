<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\Controller;
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
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:backend')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }
    
    public function guard(){
        return Auth::guard('backend');
    }
    
    public function logout(Request $request)
    {

        $this->guard()->logout();
        //$request->session()->invalidate();
        
        return redirect('/admin/login');
    }
}
