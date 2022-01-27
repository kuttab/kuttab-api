<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DailyRecord;
use App\Models\Quraan;
use App\Models\TeacherStudent;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param $id
     * @return array
     */
    public function getStudents(Request $request ,$id)
    {
        $teacherStudents = TeacherStudent::where('teacher_id', $id)->where('end_date', '>', date("Y/m/d"))->orWhere('end_date',null)->get();
        $students = [];
        foreach ($teacherStudents as $teacherStudent) {
            $students[] = User::find($teacherStudent->student_id);
        }
        if ($request->has('attend')){
            $validator = Validator::make($request->all(),[
                'date' => 'required|date',
            ]);

            if ($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ],422);
            }

            foreach ($students as $student){
                $student->isAttendance = Attendance::where('date',$request->date)->get()->first();
            }
        }

        if ($request->has('lastRecord')){
            $validator = Validator::make($request->all(),[
                'date' => 'required|date',
            ]);

            if ($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ],422);
            }

            foreach ($students as $student){
                $dailyRecord = DailyRecord::where('date',$request->date)->get()->first();
                if (is_null($dailyRecord)){
                    $student->lastRecord = null;
                }else{
                    if ($request->lastRecord == "quraan"){
                        $student->lastRecord = Quraan::where('daily_record_id',$dailyRecord->id)->get()->first();
                    }
                }
            }
        }

        return $students;
    }

    /**
     * @return mixed
     */
    public function getTeachersIdsHaveClass(){
        return TeacherStudent::where('school_id',$this->getSchoolId())->groupBy('teacher_id')->pluck('teacher_id')->all();
    }

    /**
     * @return mixed
     */
    public function getTeacherHaveClass(){
        $teachers = User::whereIn('id',$this->getTeachersIdsHaveClass())->get();
        foreach ($teachers as $teacher){
            $query = TeacherStudent::where('teacher_id',$teacher->id)->with(['class'])->get();
            $teacher->class = $query->first()->class;
            $teacher->studentNumber = count($query);
        }
        return $teachers;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        $teacherHaveClass = $this->getTeachersIdsHaveClass();
        return User::where('school_id',$this->getSchoolId())->where('type','teacher')->whereNotIn('id', $teacherHaveClass)->get();
    }



}
