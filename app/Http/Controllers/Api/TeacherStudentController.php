<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherStudent;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Http\Request;

class TeacherStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeacherStudent::with(['teacher'])->get();
    }


    public function store(Request $request)
    {
        $teacherStudent = TeacherStudent::insert($request->students);

        $data = [
            'status' => true,
            'message' => 'تمت العملية',
            'data' => $teacherStudent,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacherStudent = TeacherStudent::find($id);
        if (is_null($teacherStudent)) {
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب البيانات',
            'data' => $teacherStudent
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacherStudent = TeacherStudent::find($id);
        if (is_null($teacherStudent)) {
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }

        $teacherStudent->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل البيانات',
            'data' => $teacherStudent
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $teacherStudent = TeacherStudent::find($id);
        if (is_null($teacherStudent)) {
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }
        $teacherStudent->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم الحذف',
        ]);
    }

}
