<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Request;

class RoleController extends Controller
{
    /**
     * Role Index
     * @param void
     * @return view
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Role"]];
        $permissions = Permission::all();
        return view('/content/apps/otorisasi/role/index', ['breadcrumbs' => $breadcrumbs, 'permissions'=>$permissions]);
    }

    /**
     * Data Role
     * @param void
     * @return JSON
     * 
     */
    public function getDataRole()
    {
        try {
            DB::beginTransaction();
            $query = Role::with('permissions')->get();
            $data = ['data'=>$query];
            DB::commit();
            return response()->json($data,201);
        } catch (\Throwable $th) {
            return response()->json($th,500);
        }
    }

    /**
     * Save Data Role
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        try {

            $message = [
                'txtRole.required'          => 'Kolom Role Wajib Diisi',
                'checkPermissions.required' => 'Silahkan Pilih Permission Pengguna',
            ];
    
            $validator =  Validator::make($request->all(), [
                'txtRole' => 'required',
                'checkPermissions' => 'required'
            ],$message);
    
            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            DB::beginTransaction();

            //Insert Data
            $role = Role::create([
                'name' => $request->txtRole
            ]);

            //Set Permission
            $role->givePermissionTo($request->checkPermissions);
            DB::commit();

            //Return Data
            return response()->json($role,200);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th,500);
        }
    }

    /**
     * Hapus Data Role
     * @param id
     * @return param
     */
    public function destroy($id)
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Role::findOrFail($id);
                $query->delete();
                DB::commit();
                return response()->json($query,200);
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                return response()->json($th,500);
            }
        }

        return redirect()->route('405');
    }

    /**
     * Edit Data
     * @param id
     * @return data
     */
    public function edit($id)
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                //get role
                $query = Role::with('permissions')->findOrFail($id);
                DB::commit();

                return response()->json($query,201);

            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
            }
        }

        return redirect()->route('405');
    }

    /**
     * Update Data Role
     * @param Request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            try {
                $message = [
                    'txtRole.required'          => 'Kolom Role Wajib Diisi',
                    'checkPermissions.required' => 'Silahkan Pilih Permission Pengguna',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtRole' => 'required',
                    'checkPermissions' => 'required'
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = Role::findOrFail($id);
                $query->name = $request['txtRole'];
                $query->update();

                $query->syncPermissions($request->checkPermissions);
                DB::commit();
                return response()->json($query,200);
        
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json('$th',500);
            }
        }

        return redirect()->route('405');
    }


}
