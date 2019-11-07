<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Socialite;
use App\User;
use Illuminate\Http\Request;

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
    // protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function login($user){
        $token = null;
		try {
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return ["token"=> $token, "user"=>$user];
        //return response()->json(compact('token', 'user'));
    }
    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic
        $infoToken = null;
        $user = Socialite::driver($provider)->stateless()->user();
        $usuario = User::where([
            ['email', '=', $user['email']],
            ['id_rol','<>',4]
        ])->first();

        if($usuario != null){
            if($user){
                $infoToken =$this->login($usuario);
            }
            $user['infoToken'] = $infoToken;
            if($user->avatar != $usuario->imagen){
                User::where('email', '=', $user['email'])->update(array('imagen'=> $user->avatar));
            }
        }else{
            $user['infoToken'] = 0;
        }
        return response()->json($user);
    }
    public function handleProviderCallback(Request $request)
    {
        // $s_user = Socialite::with($request->provider)->stateless()->userFromToken($request->access_token);
        $s_user = Socialite::driver($request->provider)->stateless()->user();
        return response()->json($s_user);
    }
    public function status(){
        return response()->json("{Hola Chino!}");
    }
}
