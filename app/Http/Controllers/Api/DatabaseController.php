<?php

namespace App\Http\Controllers\Api;

use App\Exports\AdminsExport;
use App\Exports\SchoolsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\AdminsImport;
use App\Imports\SchoolsImport;
use App\Imports\UsersImport;
use http\Env\Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Validator;
use Zip;

class DatabaseController extends Controller
{
    public function export()
    {
         Excel::store(new SchoolsExport(),'public/DatabaseBackup/schools.xlsx');
         //Excel::store(new UsersExport(),'public/DatabaseBackup/users.xlsx');
         Excel::store(new AdminsExport(),'public/DatabaseBackup/admins.xlsx');

        $fileName = 'db_backup_'.date("Y_m_d").'.zip';
        $path = public_path($fileName);
        $isExists = File::exists($path);
        if($isExists){
            File::delete($path);
        }
        $zip = Zip::create($path);
        $files = public_path('storage');
        $zip->add($files,true);
        $zip->close();

        return response()->download($path);

    }

    public function import(Request $request){
        $validator = Validator::make($request->all(),[
            'db_backup_file' => 'nullable|file',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ],422);
        }
        $dbBackup = $request->file('db_backup_file');
        if ($dbBackup){
            $fileName = $dbBackup->getClientOriginalName();
            $dbBackup->move(public_path(),$fileName);
            $is_valid = Zip::check(public_path($fileName));
            if ($is_valid){
                $zip = Zip::open(public_path($fileName));
                $zip->extract(public_path('storage'));
                $zip->close();
            }
        }

        //Excel::import(new UsersImport, 'public/DatabaseBackup/users.xlsx');
        Excel::import(new SchoolsImport, 'public/DatabaseBackup/schools.xlsx');
        Excel::import(new AdminsImport, 'public/DatabaseBackup/admins.xlsx');

        return response()->json('done');
    }
}
