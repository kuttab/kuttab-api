<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
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
        $school_id = auth('sanctum')->user()->school_id;
        return User::where('school_id',$school_id)->get();
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
            'school_id' => 'required|exists:schools,id',
            'mobile_number' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'created_by' => 'required',
            'image' => 'nullable|file'
        ]);

        if ($validator->fails()){
            $data = [
                'status' => false,
                'message' => $validator->errors()->first(),
                //'by' => auth('sanctum')->user()->id,
            ];
            //SystemLog::create($data);
            return response()->json($data,422);
        }

        $username = $this->generateUserName($request['school_id']);
        $image = '';
        if ($request->hasFile('image')){
            $image = $request->file('image')->store('usersImages');
        }

        $user = User::create([
            'uid' => (string) Str::orderedUuid(),
            'username' => $username,
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
            'image' => $image,
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
            //'by' => auth('sanctum')->user()->id,
            'data' =>  $user,
        ];

        //SystemLog::create($data);
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
        $user = User::find($id);

        if (is_null($user)){
            return $this->userNotFound();
        }

        $data = [
            'status' => true,
            'message' => 'تم جلب بيانات المستخدم',
            //'by' => auth('sanctum')->user()->id,
            'data' => $user,
        ];
        //SystemLog::create($data);
        return response()->json($data);
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
        $user = User::find($id);
        if (is_null($user)){
            return $this->userNotFound();
        }
        if ($request['password']){
            $request['password'] = bcrypt($request['password']);
        }
        $user->fill($request->all())->save();

        $data = [
            'status' => true,
            'message' => 'تم تعديل بيانات المستخدم',
            //'by' => auth('sanctum')->user()->id,
            'data' => $user,
        ];

        //SystemLog::create($data);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)){
            return $this->userNotFound();
        }

        $user->delete();

        $data = [
            'status' => true,
            'message' => 'تم حذف المستخدم',
            //'by' => auth('sanctum')->user()->id,
            'data' => $user,
        ];

        //SystemLog::create($data);
        return response()->json($data);
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
            $lastUserName = $users->last()->username;
            $lastUserId = intval(substr($lastUserName,-4));
            $username = $schoolId . $year . str_pad($lastUserId+1, 4, '0', STR_PAD_LEFT);
        }

        return $username;
    }

    public function userNotFound(){
        $data = [
            'status' => false,
            'message' => 'مستخدم غير موجود',
            //'by' => auth('sanctum')->user()->id,
        ];
        //SystemLog::create($data);
        return response()->json($data);
    }

}
