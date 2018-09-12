<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Model\User;

class PassportController extends Controller
{
    
    public $successStatus = 200;
    
    protected $routePrefix = 'api';
    
    /**
     * 管理私人访问令牌,私人访问令牌总永不过期
     * php artisan passport:client --personal
     * 涉及的表oauth_clients和oauth_personal_access_clients
     *
     * @method get
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\API\Controller::index()
     */
    public function index()
    {
        return parent::index();
    }
    
    /**
     *
     * api login
     * @method post
     * @param string email
     * @param string password
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'success' => $success
            ], $this->successStatus);
        } else {
            return response()->json([
                'error' => 'Unauthorised'
            ], 401);
        }
    }
    
    /**
     * Register api
     *
     * @method post
     * @param string name
     * @param string email
     * @param string password
     * @param string c_password
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        
        return response()->json([
            'success' => $success
        ], $this->successStatus);
    }
    
    /**
     * user details api
     *
     * @return \Illuminate\Http\Response
     */
    function getDetails()
    {
        $user = Auth::user();
        return response()->json([
            'success' => $user
        ], $this->successStatus);
    }
}
