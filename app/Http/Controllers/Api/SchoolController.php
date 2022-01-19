<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Models\Admin;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchoolResource::collection(School::all());
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
            'name' => 'required',
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'logo' => 'required',
            'language' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $school = School::create($request->all());
        $admin = $this->createAdmin($school->id);

        $data = [
            'status' => true,
            'message' => 'تم انشاء مركز تحفيظ جديد',
            'data' => [
                'school' => $school,
                'admin' => $admin
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات مركز التحفيظ',
            'data' => new SchoolResource($school)
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }

        $school->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات مركز تحفيظ',
            'data' => $school
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }
        $school->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف مركز تحفيظ',
        ]);
    }

    public function createAdmin($school_id){
        $lastAdmin = Admin::where('school_id',$school_id)->orderBy('id','DESC')->get()->first();
        $adminId = 1;

        if (!is_null($lastAdmin)){
            $adminId = intval(substr($lastAdmin->username, -2))+1;
        }

        $username = 'admin-' . str_pad($school_id, 3, '0', STR_PAD_LEFT) . str_pad($adminId, 2, '0', STR_PAD_LEFT);
        $password = $this->randomPassword();
        $admin = Admin::create(['username' => $username, 'password' => bcrypt($password),'school_id' => $school_id]);

        $token = $admin->createToken('token')->plainTextToken;

        return [
            'username' => $username,
            'password' => $password,
            'school_id' => $school_id,
            'token' => $token
        ];
    }

    function randomPassword() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,8);
    }

}
