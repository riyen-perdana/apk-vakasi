<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Semester;

class SemesterController extends Controller
{
    /**
     * Fungsi Index
     * @param Void
     * @return Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Semester"]];
        return view('/content/apps/semester/index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Fungsi Get Semester
     * @param Void
     * @return Response
     */
    public function getDataSemester()
    {
        if (request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Semester::orderBy('id_smt','ASC')->get();
                $data = ['data'=>$query];
                DB::commit();

                return response()->json($data,200);

            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
            }
        }

        return redirect()->route('405');
    }

    /**
     * Hapus Data Semester
     * @param void
     * @return Response
     */
    public function destroy()
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Semester::query()->delete();
                DB::commit();
                return response()->json($query,200);

            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
        //return redirect()->route('405');
    }

    /**
     * Simpan Data Semester dari iRaise
     * @param dataList
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $query = new Semester();
            $query->id_smt = $request['id_smt'];
            $query->nm_semester = $request['nm_smt'];
            $query->a_periode_aktif = $request['a_periode_aktif'];
            $query->save();
            DB::commit();
            return response()->json($query,200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th,500);
        }        
    }

    /**
     * Update Data Semester
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id) 
    {
        if($id) {
            try {
                DB::beginTransaction();
                $query = Semester::where('a_periode_aktif','=','1')->first();
                $query->a_periode_aktif = '0';
                $query->update();
                DB::commit();

                $query = Semester::where('id_smt','=',$id)->first();
                $query->a_periode_aktif = '1';
                $query->update();
                DB::commit();

                return response()->json($query,200);

            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
            }
        }

        //return redirect()->route('405');
    }
}
