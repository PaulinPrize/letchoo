<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SocialMediaController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin(){
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->_registerOrLoginFacebook($user);
        return redirect()->route('dashboard');
    }

    protected function _registerOrLoginFacebook($data){
        $user = User::where('email', '=', $data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->email_verified_at = Carbon::now();
            $user->facebook_id = $data->id;
            $user->save();

            $last_insert_id = User::all()->last()->id;

            DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => $last_insert_id,]);
        }
        Auth::login($user);
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function googleSignin(){
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginGoogle($user);
        return redirect()->route('dashboard');
    }

    protected function _registerOrLoginGoogle($data){
        $user = User::where('email', '=', $data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->email_verified_at = Carbon::now();
            $user->google_id = $data->id;
            $user->save();

            $last_insert_id = User::all()->last()->id;

            DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => $last_insert_id,]);
        }
        Auth::login($user);
    }

}
