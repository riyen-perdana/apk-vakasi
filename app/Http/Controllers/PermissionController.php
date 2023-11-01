<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;



class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Permissions"]];
        return view('/content/apps/otorisasi/permission/index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Showing Permissions Data
     * 
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function getDataPermission()
    {
        try {
            DB::beginTransaction();
            $query = Permission::all();
            $data = ['data'=>$query];
            DB::commit();
            return response()->json($data,201);
        } catch (\Throwable $th) {
            return response()->json($th,500);
        }
    }
}
