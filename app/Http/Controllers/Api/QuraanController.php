<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quraan;
use Validator;
use Illuminate\Http\Request;

class QuraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quraan::all();
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
            'type' => 'required',
            'daily_record_id' => 'required|exists:daily_records,id',
            'from_sura' => 'string',
            'from_aya' => 'string',
            'to_sura' => 'string',
            'to_aya' => 'string',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }

        $quraan = Quraan::create($request->all());

        $data = [
            'status' => true,
            'message' => 'تم ادراج سجل حفظ قرآن جديد',
            'data' => $quraan,
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
        $quraan = Quraan::find($id);
        if (is_null($quraan)){
            return response()->json([
                'status' => false,
                'message' => 'سجل حفظ قرآن غير موجود'
            ]);
        }

        $quraan->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل سجل حفظ قرآن',
            'data' => $quraan
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
        $quraan = Quraan::find($id);
        if (is_null($quraan)){
            return response()->json([
                'status' => false,
                'message' => 'سجل غير موجود'
            ]);
        }
        $quraan->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف سجل حفظ قرآن',
        ]);
    }
}
