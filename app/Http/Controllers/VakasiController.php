<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vakasi;
use Illuminate\Support\Facades\DB;
use App\Semester;

class VakasiController extends Controller
{
    /**
     * Display Index
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Vakasi"]];
        $query_semester = Semester::orderBy('id_smt','DESC')->get();
        return view('/content/apps/vakasi/index', ['breadcrumbs' => $breadcrumbs,'semester'=> $query_semester]);
    }

    /**
     * Simpan Data Perangkat dan Data Semester
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = new Vakasi();
            $query->id_smt = $request['smt'][0]['id_smt'];
            $query->nip_dkn = $request['dekan']['nip'];
            $query->nm_dkn = $request['dekan']['nama'];
            $query->nip_ppk = $request['ppk']['nip'];
            $query->nm_ppk = $request['ppk']['nama'];
            $query->nip_bp = $request['bp']['nip'];
            $query->nm_bp = $request['bp']['nama'];
            $query->nip_ppk_rm = $request['ppk_rm']['nip'];
            $query->nm_ppk_rm = $request['ppk_rm']['nama'];
            $query->nip_bpp_rm = $request['bpp_rm']['nip'];
            $query->nm_bpp_rm = $request['bpp_rm']['nama'];
            $query->save();

            DB::commit();
            return response()->json($query->id,200);

        } catch (\Throwable $th) {
            return response()->json('error',500);
        }
    }
}
