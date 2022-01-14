<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
   public function getStudents($id){
       $teacherStudents = TeacherStudent::where('teacher_id',$id)->where('end_date' ,'>',date("Y/m/d"))->get();

       $students = [];
       foreach ($teacherStudents as $teacherStudent){
           array_push($students,User::find($teacherStudent->id)) ;
       }

       return $students;
   }
}
