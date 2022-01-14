<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassCategory;
use Illuminate\Http\Request;
use Validator;

class ClassCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassCategory::all();
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
            'class_id' => 'required|exists:classes,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $classCategory = ClassCategory::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تمت الاضافة',
            'data' => $classCategory,
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //$id = class_id
        $classCategory = ClassCategory::where('class_id',$id)->where('category_id',$request->category_id)->first();

        if (is_null($classCategory)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود',
            ]);
        }

        return $classCategory;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $classCategory = ClassCategory::where('class_id',$id)->where('category_id',$request->category_id)->first();

        if (is_null($classCategory)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود',
            ]);
        }

        $classCategory->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف السجل',
        ]);
    }
}
