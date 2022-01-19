<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function userLogin(Request $request){
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username',$fields['username'])->first();

        return $this->checkUser($user,$fields);

    }

    public function adminLogin(Request $request){
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Admin::where('username',$fields['username'])->first();

        return $this->checkUser($user,$fields);

    }

    public function logout(){
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل الخروج'
        ]);
    }

    public function user(){
        return auth('sanctum')->user();
    }

    public function checkUser($user,$fields){
        if (!$user){
            return response()->json([
                'status' => false,
                'message' => 'المستخدم غير موجود'
            ],401);
        }

        if (!$user || !Hash::check($fields['password'],$user->password)){
            return response()->json([
                'status' => false,
                'message' => 'خطأ في كلمة السر'
            ],401);
        }

        $token = $user->createToken('token')->plainTextToken;

        $user->token = $token;

        return response()->json($user);
    }

    public function verify(Request $request){
        if (auth('sanctum')->check()){
            $user = auth('sanctum')->user();
            $user->token = $request->bearerToken();
            return $user;
        }

        return response()->json('',401);
    }
}
