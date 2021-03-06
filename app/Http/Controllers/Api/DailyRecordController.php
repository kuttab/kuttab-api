<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyRecord;
use Validator;
use Illuminate\Http\Request;

class DailyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DailyRecord::all();
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
            'type' => 'required',
            'school_id' => 'required|exists:schools,id',
            'teacher_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'review' => 'string',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $dailyRecord = DailyRecord::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم اضافة سجل انجاز يومي جديد',
            'data' => $dailyRecord,
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
        $dailyRecord = DailyRecord::find($id);
        $dailyRecord->quraan;
        $dailyRecord->sunna;
        return $dailyRecord;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
