<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssistantResource;
use App\Http\Resources\UserResource;
use App\Models\Assistant;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assistants = User::where('school_id',$request->school_id)->where('type','assistant')->get();
        return new UserResource($assistants);
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
            'teacher_id' => 'required|exists:users,id',
            'assistant_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $assistant = Assistant::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم اضافة مساعد جديد',
            'data' => new AssistantResource($assistant),
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $assistant = Assistant::where('teacher_id',$request->teacher_id)->where('assistant_id',$id)->get()->first();
        if (is_null($assistant)){
            return response()->json([
                'status' => false,
                'message' => 'غير موجود'
            ]);
        }
        $assistant->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف مساعد',
        ]);
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        $assistantHaveTeacher = Assistant::pluck('assistant_id')->all();
        return User::where('type','assistant')->whereNotIn('id', $assistantHaveTeacher)->get();
    }
}
