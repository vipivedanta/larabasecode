<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Exception;
use App\User;
use Hash;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(){
        try{
            
            $user = Socialite::driver('google')->user();
            $userExisting = User::where('email',$user->email)->first();

            if($userExisting != null){
                auth()->login($userExisting,true);
            }else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->avatar = $user->avatar;
                $newUser->avatar_original = $user->avatar_original;
                $newUser->password = Hash::make(str_random(6));
                $newUser->google_id = $user->id;
                $newUser->user_base = 2; //google user
                $newUser->save();
                auth()->login($newUser,true);
            }

            return redirect()->to('home');


        }catch(\Exception $e){
            dd($e);
            return redirect('/login');
        }
    }
}
