<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(auth('sanctum')->user()->id);
        return UserResource::collection($users);
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
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
            'school_id' => 'required',
            'mobile_number' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $User = User::create([
            'uid' => (string) Str::orderedUuid(),
            'username' => $this->generateUserName($request['school_id']),
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'type' => $request['type'],
            'school_id' => $request['school_id'],
            'nationality' => $request['nationality'],
            'country' => $request['country'],
            'city' => $request['city'],
            'address' => $request['address'],
            'birth_date' => $request['birth_date'],
            'mobile_number' => $request['mobile_number'],
            'telephone_number' => $request['telephone_number'],
            'image' => $request['image'],
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'academic' => $request['academic'],
            'created_by' => $request['created_by'],
            'updated_by' => $request['updated_by'],
        ]);

        $data = [
            'status' => true,
            'message' => 'تم انشاء مستخدم جديد',
            'data' => [
                'User' => new UserResource($User)
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
        $User = User::find($id);
        if (is_null($User)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المستخدم',
            'data' => [
                'User' => new UserResource($User)
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
        $User = User::find($id);
        if (is_null($User)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        if ($request['password']){
            $request['password'] = bcrypt($request['password']);
        }
        $User->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات المستخدم',
            'data' => [
                'User' => new UserResource($User)
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
        $User = User::find($id);
        if (is_null($User)){
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        $User->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف المستخدم',
        ]);
    }

    //username = school_id + year + 0000
    public function generateUserName($school_id){
        $year = strval(date("Y"));
        $schoolId = strval($school_id);
        $users = DB::table('users')->where('school_id',$school_id)->get();
        $username = '';
        $userId = 0;

        if ($users->count() == 0){
            $username = $schoolId . $year . str_pad($userId+1, 4, '0', STR_PAD_LEFT);
        }else{
            $lastUserName = $users->latest()->first()->username;
            $lastUserId = intval(substr($lastUserName,-4));
            $username = $schoolId . $year . str_pad($lastUserId+1, 4, '0', STR_PAD_LEFT);
        }

        return $username;
    }
}
