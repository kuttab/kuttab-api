<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyRecord;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    public function getLastRecordsByLimit($id, Request $request)
    {
        $lastRecordsByLimit = DailyRecord::where('student_id', $id)
            ->orderBy('id', 'DESC')
            ->take($request->limit)
            ->with(['quraan'])
            ->get();
        return $lastRecordsByLimit;
    }

    public function getLastRecordsByDate($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        $from = $request->from;
        $to = $request->to;

        $lastRecordsByDate = DailyRecord::all()->groupBy('date');
        return $lastRecordsByDate;
    }

    public function searchByUserName(Request $request)
    {
        $student = User::where('username', $request->username)->get()->first();
        if (is_null($student)) {
            return response()->json([
                'status' => false,
                'message' => 'الطالب غير موجود',
            ]);
        }

        return $student;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        $studentHaveTeacher = TeacherStudent::pluck('student_id')->all();
        return User::where('type','student')->whereNotIn('id', $studentHaveTeacher)->get();
    }
}
