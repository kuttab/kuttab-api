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
        $date = $request->date;
        /// anas code
        $teacherStudents = User::with(['attendances'=> function($q) use ($request) {
            $q->where('date',$request->date);
        },'lastDailyRecord'=> function($q) use ($date) {
            $q->with('quraan')->where('date',$date)->where("type","quraan");
        }])->whereHas('teacher', function ( $query) use($id,$date) {
            $query->where('teacher_id',$id)->where('end_date', '>', $date)->orWhere('end_date',null);
        })->get();

        foreach($teacherStudents as $k => $s){
            $teacherStudents[$k]->isAttendance = (!empty($s->attendances->toArray()) ) && $s->attendances[0]->is_attended;
            $teacherStudents[$k]->isDailyRecord = $teacherStudents[$k]->isAttendance && (!empty($s->lastDailyRecord->toArray()) );
            $teacherStudents[$k]->isRecord = (!empty($s->attendances->toArray()) );
            if(!empty($s->lastDailyRecord->toArray()) ){
                $teacherStudents[$k]->daily_record = $s->lastDailyRecord[0]->quraan;
            }else{
                $teacherStudents[$k]->daily_record = null;
            }

        }
        return $teacherStudents;
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
