<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sunna;
use Validator;
use Illuminate\Http\Request;

class SunnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sunna::all();
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
            'daily_record_id' => 'required|exists:daily_records,id',
            'book_name' => 'required',
            'hadith_number' => 'string',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $sunna = Sunna::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم ادراج سجل حفظ حديث جديد',
            'data' => $sunna,
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
        //
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
        $sunna = Sunna::find($id);
        if (is_null($sunna)){
            return response()->json([
                'status' => false,
                'message' => 'سجل حفظ حديث غير موجود'
            ]);
        }

        $sunna->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل سجل حفظ حديث',
            'data' => $sunna
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
        $sunna = Sunna::find($id);
        if (is_null($sunna)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }

        $sunna->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف سجل حفظ حديث',
        ]);
    }
}
