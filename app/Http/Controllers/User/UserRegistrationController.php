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
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRegistrationController extends Controller
{
    public function show(){

        return view('User.user_registration');
    }

    public function registerUserData(Request $request){

        
        try {
            // Define validation rules
            $rules = [
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'email',
                    'unique:users,username', 
                ],
                'password' => [
                    'required',
                    'string',
                    
                ],
                'confirm_password' => 'required|same:password',
                'mobile_number' => 'required',
                'language' => 'required',
            ];

            // Define custom error messages
            $messages = [
                'confirm_password.same' => 'The confirmation password does not match.'
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules, $messages);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            DB::beginTransaction();
                // Check if the user already exists, including soft deleted users
                $user = User::withTrashed()->where('username', $request->username)->first();

                if ($user) {
                    if ($user->trashed()) {
                        // Restore the soft deleted user
                        $user->restore();
                        $user->update([
                            'name' => $request->name,
                            'password' => Hash::make($request->password),
                            'mobile_number' => $request->mobile_number,
                            'language' => $request->language,
                        ]);
                    } else {
                        // Active user already exists
                        return response()->json(['status' => 403, 'success' => false, 'message' => 'Email Already Exist']);
                    }
                } else {
                    // Create a new user
                    $user = User::create([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'name' => $request->name,
                        'mobile_number' => $request->mobile_number,
                        'language' => $request->language,
                    ]);
                }

                // dd($user);
            DB::commit();
            $user_data = $user;
            
            Mail::to($user->username)->send(new VerificationEmail($user_data));
            return response()->json(['success' => true, 'message' => 'Mail Send successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data']);
        }
    }

    public function verifyEmail($id){

        // dd($id); 
        User::where('id', $id)->update([
            'email_verified' => 1,
            'is_active' => 1
        ]);
        
        return redirect('/login');

    }

    
}
