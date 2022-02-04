<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\DailyRecord;
use App\Models\ParentChild;
use App\Models\TeacherStudent;
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
        $school_id = $this->getSchoolId();
        $parents = ParentChild::pluck('parent_id')->all();
        return User::where('school_id',$school_id)->where('type','parent')->whereIn('id', $parents)->with(['children.child'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $school_id = $this->getSchoolId();
        $children_ids = explode(',',$request->children_ids);

        $validator = Validator::make(['parent_id'=>$request->parent_id,'children_ids'=>$children_ids],[
            'parent_id' => 'required|exists:users,id',
            'children_ids' => 'required|array|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $parentChildren = [];
        foreach ($children_ids as $child_id){
            $parentChildren [] = [
                'school_id' => $school_id,
                'parent_id' => $request->parent_id,
                'child_id' => $child_id
            ];
        }

        $parentChild = ParentChild::insert($parentChildren);

        $data = [
            'status' => true,
            'message' => 'تم ادراج عائلة جديد',
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
        ParentChild::where('parent_id',$id)->delete();
       /* $parentChild = ParentChild::where('parent_id',$id)->where('child_id',$request->child_id)->first();

        if (is_null($parentChild)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود',
            ]);
        }

        $parentChild->delete();*/
        return response()->json([
            'status' => true,
            'message' => 'تم حذف السجل',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getChildren(Request $request,$id){
        $teacherStudents = User::with(['attendances'=> function($q) use ($request) {
            $q->where('date',$request->date);
        },'lastDailyRecord'=> function($q) use ($request) {
            $q->with('quraan')->where('date',$request->date)->where("type","quraan");
        }])->whereHas('parent', function ( $query) use($id) {
            $query->where('parent_id',$id);
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
     * @param $id
     * @return array
     */
    public function lastRecordForEachChild($id){
        $parentChildren = ParentChild::where('parent_id',$id)->with(['child.lastDailyRecord.quraan'])->get();
        $childrenWithLastRecord = [];
        foreach ($parentChildren as $parentChild){
            array_push($childrenWithLastRecord,$parentChild->child) ;
        }

        return $childrenWithLastRecord;
    }

    /**
     * @return void
     */
    public function getAvailableParent(){
        $families = ParentChild::pluck('parent_id')->all();
        return User::where('type','parent')->whereNotIn('id', $families)->get();
    }

    /**
     * @return void
     */
    public function getAvailableChildren(){
        $families = ParentChild::pluck('child_id')->all();
        return User::where('type','student')->whereNotIn('id', $families)->get();
    }

}
