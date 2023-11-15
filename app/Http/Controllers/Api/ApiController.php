<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Semester;

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
}
