<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyRecord;
use App\Models\ParentChild;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ParentChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ParentChild::all();
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
            'school_id' => 'required|exists:schools,id',
            'parent_id' => 'required|exists:users,id',
            'child_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $parentChild = ParentChild::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم ادراج طفل جديد',
            'data' => $parentChild,
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
        //$id = parent_id
        $parentChild = ParentChild::where('parent_id',$id)->where('child_id',$request->child_id)->first();

        if (is_null($parentChild)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود',
            ]);
        }

        $parentChild->parent;
        $parentChild->child;
        return $parentChild;
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
        $parentChild = ParentChild::where('parent_id',$id)->where('child_id',$request->child_id)->first();

        if (is_null($parentChild)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود',
            ]);
        }

        $parentChild->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف السجل',
        ]);
    }

    public function getChildren($id){
        $parentChildren = ParentChild::where('parent_id',$id)->with(['child'])->get();
        $children = [];
        foreach ($parentChildren as $parentChild){
            array_push($children,$parentChild->child) ;
        }

        return $children;
    }

    public function lastRecordForEachChild($id){
        $parentChildren = ParentChild::where('parent_id',$id)->with(['child.lastDailyRecord.quraan'])->get();
        $childrenWithLastRecord = [];
        foreach ($parentChildren as $parentChild){
            array_push($childrenWithLastRecord,$parentChild->child) ;
        }

        return $childrenWithLastRecord;
    }

}
