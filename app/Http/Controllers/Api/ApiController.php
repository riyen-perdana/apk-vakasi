<?php

namespace App\Http\Controllers\Api;

use App\Dosenlb;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Semester;
use Illuminate\Support\Facades\DB;
use App\Perangkat;
use \App\Enums\JabatanStatus;

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

            $response_db = [];
            DB::beginTransaction();

            $query_semester = Semester::select('id_smt','nm_semester')->where('a_periode_aktif','1')->first();
            //$response_db['smt'] = $query_semester;

            $query = DB::table('dosenlb')->select('nup_nidn','name','pangkat.pangkat','jbtn_fungsional', 'a_ajr','a_aws','a_krk','a_soal')
                    ->join('pangkat', 'pangkat.id', '=', 'dosenlb.pangkat')
                    ->join('fungsional', 'fungsional.id', '=', 'dosenlb.fungsional')
                    ->join('setting','setting.fungsional','=','fungsional.id' )
                    //->where('nup_nidn','=',request()->nup_nidn)
                    ->get()->toArray();

            if($query) {
                $dsn = [];
                for ($i=0; $i < count($query) ; $i++) {
                    $bad = [];
                    $resp_dsn = Http::get($this->host.'/get-bad-dosen',
                        [
                            'token' => $this->token,
                            'id_smt' => $query_semester->id_smt,
                            'nup' => $query[$i]->nup_nidn,
                            'id_sms' => config('custom.app_fak')
                        ])->json();

                    $bad['bad'] = $resp_dsn;              
                    $dsn[] = array_merge((array)$query[$i],$bad);
                }
                
            }
            DB::commit();
                
            $response_db['dsn'] = $dsn;
            return $response_db;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getDataDosenLb()
    {
        try {
            DB::beginTransaction();
           
            $query = DB::table('dosenlb')->select('id','nup_nidn')->get()->toArray();

            DB::commit();
            return $query;

        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function getDataBadDosenLb()
    {
        try {
            DB::beginTransaction();
            $resp_dsn = Http::get($this->host.'/get-bad-dosen',
                        [
                            'token' => $this->token,
                            'id_smt' => request()->id_smt,
                            'nup' => request()->nup_nidn,
                            'id_sms' => config('custom.app_fak')
                        ]);
            DB::commit();
            return $resp_dsn;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getDataSemesterPerangkat()
    {
        try {
            $data = [];
            DB::beginTransaction();
            $query_perangkat = Perangkat::all();
            $query_semester  = Semester::where('id_smt','=',request()->id_smt)->get()->toArray();
            DB::commit();
            $data['smt'] = $query_semester;

            //Pecah Data Perangkat Sesuai Peranannya
            foreach ($query_perangkat as $item) {
                if($item->is_jabatan == 'Dekan' ) {
                    $data['dekan'] = ['nip' => $item->nip, 'nama' => $item->nama_perangkat];
                } else if ($item->is_jabatan == 'Bendahara Pengeluaran') {
                    $data['bp'] = ['nip' => $item->nip, 'nama' => $item->nama_perangkat];
                } else if ($item->is_jabatan == 'Pejabat Pembuat Komitmen') {
                    $data['ppk'] = ['nip' => $item->nip, 'nama' => $item->nama_perangkat];
                } else if ($item->is_jabatan == 'PPK RM') {
                    $data['ppk_rm'] = ['nip' => $item->nip, 'nama' => $item->nama_perangkat];
                } else if ($item->is_jabatan == 'BPP Rupiah Murni') {
                    $data['bpp_rm'] = ['nip' => $item->nip, 'nama' => $item->nama_perangkat];
                }
            }
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
