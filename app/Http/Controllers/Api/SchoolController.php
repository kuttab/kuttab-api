<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Validator;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchoolResource::collection(School::all());
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
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'logo' => 'required',
            'language' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $school = School::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم انشاء مركز تحفيظ جديد',
            'data' => new SchoolResource($school),
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات مركز التحفيظ',
            'data' => new SchoolResource($school)
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }

        $school->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات مركز تحفيظ',
            'data' => new SchoolResource($school)
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
        $school = School::find($id);
        if (is_null($school)){
            return response()->json([
                'status' => false,
                'message' => 'مركز تحفيظ غير موجود'
            ]);
        }
        $school->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف مركز تحفيظ',
        ]);
    }

}
