<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return view('/content/apps/otorisasi/role/index', ['breadcrumbs' => $breadcrumbs]);
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


}
