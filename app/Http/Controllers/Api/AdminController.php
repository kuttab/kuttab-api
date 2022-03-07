<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Admin[]|Collection
     */
    public function index()
    {
        return Admin::all()->except(auth('sanctum')->user()->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'school_id' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $admin = Admin::create([
            'school_id' => $request['school_id'],
            'username' => $request['username'],
            'password' => bcrypt($request['password'])
        ]);

        $data = [
            'status' => true,
            'message' => 'تم انشاء مسؤول جديد',
            'data' => $admin,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المسؤول',
            'data' => new AdminResource($admin)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        if ($request['password']) {
            $request['password'] = bcrypt($request['password']);
        }
        $admin->fill($request->all())->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات المسؤول',
            'data' => $admin
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
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json([
                'status' => false,
                'message' => 'مستخدم غير موجود'
            ]);
        }
        $admin->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف مسؤول',
        ]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $user = Admin::find(auth('sanctum')->user()->id);

        $fields = $request->validate([
            'oPassword' => 'required',
            'nPassword' => 'required',
        ]);

        if (!$user || !Hash::check($fields['oPassword'],$user->password)){
            return response()->json([
                'status' => false,
                'message' => ' خطأ في كلمة المرور القديمة'
            ]);
        }

        $user->password = bcrypt($fields['nPassword']);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'تم تغيير كلمة المرور'
        ]);
    }
}
