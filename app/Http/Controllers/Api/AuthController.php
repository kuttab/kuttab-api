<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
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
        auth()->user()->tokens()->delete();
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

        $data = [
            'status' => true,
            'message' =>'تم تسجيل الدخول بنجاح',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ];

        return response()->json($data);
    }

}
