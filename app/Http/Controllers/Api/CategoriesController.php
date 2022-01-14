<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
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

        $category = Category::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم انشاء فئة جديدة',
            'data' => $category,
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
        $category = Category::find($id);
        if (is_null($category)){
            return response()->json([
                'status' => false,
                'message' => 'فئة غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات الفئة',
            'data' => $category
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
        $category = Category::find($id);
        if (is_null($category)){
            return response()->json([
                'status' => false,
                'message' => 'فئة غير موجود'
            ]);
        }

        $category->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات الفئة',
            'data' => $category
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
        $category = Category::find($id);
        if (is_null($category)){
            return response()->json([
                'status' => false,
                'message' => 'فئة غير موجود'
            ]);
        }
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الفئة',
        ]);
    }

}
