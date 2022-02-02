<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\DailyRecord;
use App\Models\TeacherStudent;
use App\Models\User;
use Carbon\CarbonPeriod;
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
        $dates = $this->getAllDatesBetween($from,$to);
        $lastRecords = [];

        $student = User::with(['attendances'=> function($q) use ($from,$to) {
            $q->whereBetween('date', [$from, $to]);
        },'dailyRecord'=> function($q) use ($from,$to) {
            $q->with('quraan')->whereBetween('date', [$from, $to])->where("type","quraan");
        }])->where('id', $id)->first();


        foreach ($dates as $date){
            $std = [];
            $first = $student->attendances->where('date',$date)->first();
            if (!is_null($first)){
                $drs = $student->dailyRecord->where('date', $date);
                $drsn = [];
                foreach($drs as $dr){
                    $drsn[] = $dr->quraan;
                }
                $std = [
                    'is_attended' => $first->is_attended == '1',
                    'isDailyRecord' => (!empty($drs->toArray()) ),
                    'isRecord' => true,
                    'day' => $date,
                    'dailyRecord' => $drsn,
                ];

                // $student->daily_record = $student->lastDailyRecord[0]->quraan;
            }else{
                $std = [
                    'is_attended' => false,
                    'isDailyRecord' => false,
                    'isRecord' => false,
                    'day' => $date,
                    'dailyRecord' => null,
                ];
            }
            $lastRecords[] = $std;
        }

        return $lastRecords;
        /*
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
        $dates = $this->getAllDatesBetween($from,$to);

        $attendances =  Attendance::where('user_id',$id)->whereBetween('date', [$from, $to])->get();
        $dailyRecords = DailyRecord::where('student_id',$id)->whereBetween('date', [$from, $to])->with(['quraan'])->get();
        $lastRecords = [];

        foreach ($dates as $date){
            if (!is_null($attendances->where('date',$date)->first())){
                $lastRecords[] = [
                    'day' => $date,
                    'isAttend' => $attendances->where('date', $date)->first()->is_attended,
                    'records' => $dailyRecords->where('date', $date)
                ];
            }
        }
        return $lastRecords;
*/
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

    public function getAllDatesBetween($from,$to){
        $period = CarbonPeriod::create($from, $to);
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    public function getStudentWithClassInfo($id){
        $student = User::find($id);
        $teacherStudent = TeacherStudent::where('student_id',$id)->get()->first();
        if (!is_null($teacherStudent)) {
            $teacher = User::find($teacherStudent->teacher_id);
            $class = Classes::find($teacherStudent->class_id);
            $student->className = $class->name;
            $student->teacherName = $teacher->first_name . ' ' . $teacher->middle_name . ' ' . $teacher->last_name;
            $student->teacherPhone = $teacher->mobile_number;
        }
        return $student;
    }
}
