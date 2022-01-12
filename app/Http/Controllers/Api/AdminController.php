<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all()->except(auth('sanctum')->user()->id);
        return AdminResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'username' => 'required',
           'password' => 'required|confirmed'
        ]);

        if ($validator->fails()){
            return response()->json([
               'status' => false,
               'message' => $validator->errors->first()
            ],422);
        }

        $admin = Admin::create([
            'username' => $request['username'],
            'password' => bcrypt($request['password'])
        ]);

        $data = [
            'status' => true,
            'message' => 'تم انشاء مسؤول جديد',
            'data' => [
                'admin' => new AdminResource($admin)
            ],
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المسؤول',
            'data' => [
                'admin' => new AdminResource($admin)
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        if ($request['password']){
            $request['password'] = bcrypt($request['password']);
        }
        $admin->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات المسؤول',
            'data' => [
                'admin' => new AdminResource($admin)
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        $admin->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف مسؤول',
        ]);
    }
}
