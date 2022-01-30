<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendanceReasons;
use Validator;
use Illuminate\Http\Request;

class AttendanceReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = $this->getSchoolId();
        return AttendanceReasons::where('school_id',$school_id)->orWhere('school_id',null)->get();
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
            'title' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $attendanceReasons = AttendanceReasons::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تمت الاضافة',
            'data' => $attendanceReasons,
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
        $attendanceReasons = AttendanceReasons::find($id);
        if (is_null($attendanceReasons)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب البيانات',
            'data' => $attendanceReasons
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
        $attendanceReasons = AttendanceReasons::find($id);
        if (is_null($attendanceReasons)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }

        $attendanceReasons->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم التعديل',
            'data' => $attendanceReasons
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
        $attendanceReasons = AttendanceReasons::find($id);
        if (is_null($attendanceReasons)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }
        $attendanceReasons->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم الحذف',
        ]);
    }

}
