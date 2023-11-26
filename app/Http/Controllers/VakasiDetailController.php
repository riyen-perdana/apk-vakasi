<?php

namespace App\Http\Controllers;

use App\VakasiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VakasiDetailController extends Controller
{
    /**
     * Store Data BAD Dosen LB
     * @param Request
     * @return JSON
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if($request['bad'] != NULL) {
                foreach ($request['bad'] as $item) {
                    $query = new VakasiDetail();
                    $query->id_vakasi = $request['id_vakasi'];
                    $query->id_dsn = $request['id_dsn'];
                    $query->id_kls = $request['bad']['id_kls'];
                    $query->kode_mk = $request['bad']['kode_mk'];
                    $query->kd_prd = $request['bad']['id_sms'];
                    $query->sks_mk = $request['bad']['sks_mk'];
                    $query->kode_ruangan = $request['bad']['kode_ruangan'];
                    $query->hari = $request['bad']['hari'];
                    $query->lokal = $request['bad']['nm_program'];
                    $query->mhs = $request['bad']['mhs'];
                    $query->save();
                }
            }
            DB::commit();
            return response()->json('ok',200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json('error',500);
        }
    }
}
