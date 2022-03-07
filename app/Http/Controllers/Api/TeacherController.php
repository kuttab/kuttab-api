<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Attendance;
use App\Models\Category;
use App\Models\ClassCategory;
use App\Models\Classes;
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
        if ($request->has('date')){
            $date = $request->date;
        }else{
            $date = date("Y/m/d");
        }

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

    public function getTeacherWithClassInfo($id){
        $teacher = User::find($id);
        $teacherStudent = TeacherStudent::where('teacher_id',$id)->get();
        if (!is_null($teacherStudent)) {
            $studentsNumber = count($teacherStudent);
            $class = Classes::find($teacherStudent->first()->class_id);

            $teacher->className = $class->name;
            $teacher->classCategories = $this->getClassCategories($class->id);
            $teacher->studentNumber = $studentsNumber;
            $teacher->assistants = $this->getTeacherAssistants($id);

        }
        return $teacher;
    }

    public function getTeacherAssistants($teacher_id){
        $assistantsIds = Assistant::where('teacher_id',$teacher_id)->get('assistant_id');
        $assistants = [];
        foreach ($assistantsIds as $assistant){
            $assistants[] = User::find($assistant->assistant_id);
        }
        return $assistants;
    }

    public function getClassCategories($class_id){
        $categories = ClassCategory::where('class_id',$class_id)->get('category_id');
        $classCategories =[];
        foreach ($categories as $category){
            $category_id = $category->category_id;
            $classCategories[] = Category::find($category_id);
        }

        return $classCategories;
    }

}
