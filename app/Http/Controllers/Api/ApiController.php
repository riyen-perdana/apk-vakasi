<?php

namespace App\Http\Controllers\Api;

use App\Dosenlb;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Semester;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    private $host   = "https://api-iraise.uin-suska.ac.id/vakasi";
    private $token  = "e335253ae61824c94bf9b17312fcaafe";

    public function getSemesterAktif()
    {
        $response = Http::get($this->host.'/get-semester', [
            'token' => $this->token
        ]);
        
        return $response;
        //$this->saveSemester($response['data']);
    }

    public function saveSemester($data) {
        foreach ($data as $semester) {
            if(substr($semester['id_smt'],4,1) != '3') {
                $query = new Semester();
                $query->id_smt = $semester['id_smt'] ;
                $query->nm_semester = $semester['nm_smt'];
                $query->a_periode_aktif = $semester['a_periode_aktif'];
                $query->save();
            }
        }
    }
    
    public function getDataDosen()
    {
        try {
            DB::beginTransaction();
            //$query = Dosenlb::with('pangkat','fungsional','fungsional.setting')->where('nup_nidn',request()->nup)->get();
            $query = DB::table('dosenlb')->select('nup_nidn','name','pangkat.pangkat','jbtn_fungsional', 'a_ajr','a_aws','a_krk','a_soal')
                    ->join('pangkat', 'pangkat.id', '=', 'dosenlb.pangkat')
                    ->join('fungsional', 'fungsional.id', '=', 'dosenlb.fungsional')
                    ->join('setting','setting.fungsional','=','fungsional.id' )
                    ->where('nup_nidn',request()->nup)->get();
            return response()->json($query,200);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
