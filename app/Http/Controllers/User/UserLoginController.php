<?php

namespace App\Http\Controllers\User;

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
use Illuminate\Container\RewindableGenerator;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class UserLoginController extends Controller
{
    public function login(){

        return view('User.login');
    }

    public function userLogin(Request $request){

        $response = Http::post('http://localhost/gophygital_task/public/api/user_login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
        // Check if the request was successful
        if ($response->successful()) {
            // Decode the response to get the access token and other details
            $data = $response->json();
            $accessToken = $data['access_token'];
            $request->session()->put('access_token', $accessToken);
            return response()->json([
                'message' => 'Login successful',
                'access_token' => $accessToken,
                'is_admin' => $data['is_admin'],
                'success' => true,
            ]);
        } else {
            $error = $response->json();
            return response()->json([
                'message' => $error['message'] ?? 'Login failed',
            ], $response->status());
        }
        
    }

    public function showUserDetails(Request $request){

        $accessToken = $request->session()->get('access_token');
        $response = Http::withHeaders([
            'access-token' => $accessToken,
            'Accept' => 'application/json',
        ])->get('http://localhost/gophygital_task/public/api/user_details');

        // dd($response);
        // Check if the request was successful
        if ($response->successful()) {
            $userData = $response->json(); // Decode the JSON response
            // Return the view with the user data
            if($userData['is_admin'] == 1){
                return view('User.admin',$userData);
            }else{
                return view('User.details',compact('userData'));
            }
        } else {
            // Handle errors
            $error = $response->json();
            return view('User.details', ['error' => $error['message'] ?? 'Failed to retrieve user details']);
        }
    }

    public function updateStatus(Request $request){

        $user = User::find($request->id);

        if ($user) {
            $user->is_active = $request->is_active;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function details(){

        return view('user_details');
    }
    public function fetchDetails(Request $request)
    {   
        if(empty($request->username)){
            return response()->json([
                'success' => false,
                'message' => 'Please Enter Username'
            ]);
        }
        $username = $request->input('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $user->name,
                    'username' => $user->username,
                    'created_at' => \Carbon\Carbon::parse($user->created_at)->format('d-m-Y'),
                    'email_verified' => $user->email_verified,
                    'is_active' => $user->is_active
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
    }
}
