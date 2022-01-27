<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Category;
use App\Models\ClassCategory;
use App\Models\Classes;
use App\Models\TeacherStudent;
use Validator;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = $this->getSchoolId();
        return Classes::where('school_id' , $school_id)
                        ->with(['categories','teacherStudents'])
                        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'school_id' => 'required|exists:schools,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $class = Classes::create([
            'name' => $request->name,
            'school_id' => $request->school_id
        ]);

        if ($request->assistants_ids){
            $assistants_ids = explode(',',$request->assistants_ids);
            foreach ($assistants_ids as $assistant_id){
                Assistant::create([
                    'teacher_id' => $request->teacher_id,
                    'assistant_id' => $assistant_id
                ]);
            }
        }

        if ($request->categories_ids){
            $categories_ids = explode(',',$request->categories_ids);
            foreach ($categories_ids as $category_id){
                ClassCategory::create([
                    'class_id' => $class->id,
                    'category_id' => $category_id
                ]);
            }
        }

        if ($request->students_ids){
            $students_ids = explode(',',$request->students_ids);
            foreach ($students_ids as $student_id){
                TeacherStudent::create([
                    'school_id' => $request->school_id,
                    'class_id' => $class->id,
                    'teacher_id' => $request->teacher_id,
                    'student_id' => $student_id,
                    'start_date' => date('Y-m-d')
                ]);
            }
        }

        $data = [
            'status' => true,
            'message' => 'تم انشاء حلقة تحفيظ جديدة',
            'data' => $class,
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $class = Classes::find($id);
        if (is_null($class)){
            return response()->json([
                'status' => false,
                'message' => 'حلقة تحفيظ غير موجود'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات حلقة التحفيظ',
            'data' => $class
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
        $class = Classes::find($id);
        if (is_null($class)){
            return response()->json([
                'status' => false,
                'message' => 'حلقة تحفيظ غير موجود'
            ]);
        }

        $class->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات حلقة التحفيظ',
            'data' => $class
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
        $class = Classes::find($id);
        $teacher_id = $class->teacherStudents->first()->teacher_id;
        if (is_null($class)){
            return response()->json([
                'status' => false,
                'message' => 'حلقة تحفيظ غير موجود'
            ]);
        }
        TeacherStudent::where('class_id',$id)->delete();
        ClassCategory::where('class_id',$id)->delete();
        Assistant::where('teacher_id',$teacher_id)->delete();
        $class->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف حلقة التحفيظ',
        ]);
    }

}
