<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPUnit\Metadata\Uses;

class UserLoginController extends Controller
{
    public function login(){

        return view('User.login');
    }

    public function userLogin(Request $request){

        // dd($request->all());
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found'], 401);
        }

        if (!$user->email_verified) {
            return response()->json(['message' => 'Account not Verified'], 403);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'Account Disabled'], 403);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid Username/Password'], 401);
        }
            
        $token = JWTAuth::fromUser($user);
        $responseData['access-token'] = $token;
        $responseData['id'] = $user['id'];
        // Store the token in the session
        return response()->json([
            'access_token' => $responseData['access-token'],
            'user_id' => $responseData['id'],
            'is_admin'=>$user['is_admin'],
        ]);
    }


    public function getUserDetails(){

        $tokenData = Session::get('userToken');
        $token = JWTAuth::setToken($tokenData)->getPayload();

        // check token issued time for single device login
        $check_user = User::where([['id', $token['sub']],])->first();
        $is_admin = $check_user->is_admin;
        if($check_user->is_admin == 1){
            $data = User::where('email_verified',1)->where('id', '!=', $token['sub'])->get();
        }else{
            $data = User::where('id',$token['sub'])->first();
        }

        return response()->json([
            'user_data'=>$data,
            'is_admin' => $is_admin,
        ]);
        
    }

    public function readHeaderToken()
    {
        $tokenData = Session::get('wdiToken');
        $token = JWTAuth::setToken($tokenData)->getPayload();

        //convert iat to readable format
        $iat = date('Y-m-d H:i:s', $token['iat']);

        // check token issued time for single device login
        $check_iat = User::where([['id', $token['sub']],])->first();
        if ($check_iat) {
            return $token;
        } else {
            return false;
        }
    }

    
}
