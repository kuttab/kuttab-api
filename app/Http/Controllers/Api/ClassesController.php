<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
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
        return Classes::all();
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
            'name' => 'required',
            'school_id' => 'required|exists:schools,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $class = Classes::create($request->all());

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
     * @return \Illuminate\Http\Response
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
        if (is_null($class)){
            return response()->json([
                'status' => false,
                'message' => 'حلقة تحفيظ غير موجود'
            ]);
        }
        $class->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف حلقة التحفيظ',
        ]);
    }

}
