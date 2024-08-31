<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class AdminLoginController extends Controller
{
    public function adminLogin(Request $request){

        $response = Http::post('http://localhost/gophygital_task/public/api/user_login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
    }
}
