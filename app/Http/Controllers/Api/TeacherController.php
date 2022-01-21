<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param $id
     * @return array
     */
    public function getStudents($id)
    {
        $teacherStudents = TeacherStudent::where('teacher_id', $id)->where('end_date', '>', date("Y/m/d"))->get();
        $students = [];
        foreach ($teacherStudents as $teacherStudent) {
            $students[] = User::find($teacherStudent->id);
        }
        return $students;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        $teacherHaveClass = TeacherStudent::pluck('teacher_id')->all();
        return User::where('type','teacher')->whereNotIn('user_id', $teacherHaveClass)->get();
    }

}
