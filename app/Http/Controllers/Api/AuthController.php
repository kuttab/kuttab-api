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
    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->userType == 'admin'){
            $user = Admin::where('username',$fields['username'])->first();
        }else{
            $user = User::where('username',$fields['username'])->first();
        }

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
}
