<?php

namespace App\Http\Controllers;

use App\VakasiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vakasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class VakasiDetailController extends Controller
{
    /**
     * Index
     * @param void
     * @return \illuminate\http\Response
     */
    public function index(Request $request)
    {
        if($request->id) {
            $query = Vakasi::where('id','=',$request->id)->first();
            if ($query) {
                $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['link' => "/apps/vakasi", 'name' => "Vakasi"],['name' => 'Vakasi Detail']];
                
                //Query Amprah
                $query_amprah = DB::table('vakasi_detail')
                        ->join('vakasi','vakasi.id','=','vakasi_detail.id_vakasi')
                        ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                        ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                        ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                        ->join('setting','setting.fungsional','=','fungsional.id')
                        ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                 'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                 'dosenlb.npwp','dosenlb.no_rek','setting.a_ajr',DB::raw('sum(vakasi_detail.sks_mk) as SKS'),
                                 DB::raw('setting.a_ajr*sum(vakasi_detail.sks_mk)*15 as TOT'),
                                 DB::raw('(setting.a_ajr*sum(vakasi_detail.sks_mk)*15)*5/100 AS PPH'),
                                 DB::raw('setting.a_ajr*sum(vakasi_detail.sks_mk)*15-((setting.a_ajr*sum(vakasi_detail.sks_mk)*15)*5/100) AS JLM')
                        )
                        ->where([['vakasi_detail.id_vakasi','=',$request->id],['vakasi_detail.mhs','!=','NULL']])
                        ->groupBy('dosenlb.nup_nidn','setting.a_ajr')
                        ->get();

                //Query Pembuat Soal
                $query_buat_soal = DB::table('vakasi_detail')
                                   ->join('vakasi','vakasi.id','=','vakasi_detail.id_vakasi')
                                   ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                                   ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                                   ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                                   ->join('setting','setting.fungsional','=','fungsional.id')
                                   ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                    'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                    'dosenlb.npwp','dosenlb.no_rek','setting.a_soal',DB::raw('count(vakasi_detail.kode_mk) as jlm_naskah'),
                                    DB::raw('setting.a_soal*count(vakasi_detail.kode_mk) as jlm_honor'),
                                    DB::raw('(setting.a_soal*count(vakasi_detail.kode_mk))*5/100 AS PPH'),
                                    DB::raw('setting.a_soal*count(vakasi_detail.kode_mk)-(setting.a_soal*count(vakasi_detail.kode_mk))*5/100 AS JLM')
                        )
                        ->where([['vakasi_detail.id_vakasi','=',$request->id],['vakasi_detail.mhs','!=','NULL']])
                        ->groupBy('dosenlb.nup_nidn','setting.a_soal')
                        ->get();

                //Query Pengawas Ujian
                $query_mengawas = DB::table('vakasi_detail')
                                  ->join('vakasi','vakasi.id','=','vakasi_detail.id_vakasi')
                                  ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                                  ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                                  ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                                  ->join('setting','setting.fungsional','=','fungsional.id')
                                  ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                    'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                    'dosenlb.npwp','dosenlb.no_rek','setting.a_aws',DB::raw('count(vakasi_detail.kode_mk) as jlm_naskah'),
                                    DB::raw('setting.a_aws*count(vakasi_detail.kode_mk) as jlm_honor'),
                                    DB::raw('(setting.a_aws*count(vakasi_detail.kode_mk))*5/100 AS PPH'),
                                    DB::raw('setting.a_aws*count(vakasi_detail.kode_mk)-(setting.a_aws*count(vakasi_detail.kode_mk))*5/100 AS JLM')
                        )
                        ->where([['vakasi_detail.id_vakasi','=',$request->id],['vakasi_detail.mhs','!=','NULL']])
                        ->groupBy('dosenlb.nup_nidn','setting.a_aws')
                        ->get();

                //Query Pemeriksa Ujian
                $query_pengoreksi = DB::table('vakasi_detail')
                                  ->join('vakasi','vakasi.id','=','vakasi_detail.id_vakasi')
                                  ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                                  ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                                  ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                                  ->join('setting','setting.fungsional','=','fungsional.id')
                                  ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                    'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                    'dosenlb.npwp','dosenlb.no_rek','setting.a_krk',DB::raw('sum(vakasi_detail.mhs) as jlm_mhs'),
                                    DB::raw('setting.a_krk*sum(vakasi_detail.mhs) as jlm_honor'),
                                    DB::raw('(setting.a_krk*sum(vakasi_detail.mhs))*5/100 AS PPH'),
                                    DB::raw('setting.a_krk*sum(vakasi_detail.mhs)-(setting.a_krk*sum(vakasi_detail.mhs))*5/100 AS JLM')
                        )
                        ->where('vakasi_detail.id_vakasi','=',$request->id)
                        ->groupBy('dosenlb.nup_nidn','setting.a_krk')
                        ->get();

                //return $query_buat_soal;

                return view('/content/apps/vakasi-detail/index', [
                            'breadcrumbs' => $breadcrumbs,
                            'query_amprah' => $query_amprah,
                            'query_buat_soal' => $query_buat_soal,
                            'query_mengawas' => $query_mengawas,
                            'query_pengoreksi' => $query_pengoreksi,
                            'id' => $request->id
                        ]);
            }
        }
        
        return redirect()->route('error');

    }

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
                    $query->id_kls = $item['id_kls'];
                    $query->kode_mk = $item['kode_mk'];
                    $query->kd_prd = $item['id_sms'];
                    $query->sks_mk = $item['sks_mk'];
                    $query->kode_ruangan = $item['kode_ruangan'];
                    $query->hari = $item['hari'];
                    $query->lokal = $item['nm_program'];
                    $query->mhs = $item['mhs'];
                    $query->save();
                }
            }
            DB::commit();
            return response()->json('ok',200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Get Data Amprah BAD Dosen
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function printAmprah(Request $request)
    {
        try {
                $message = [
                    'txtTA.required'            => 'Kolom Tahun Anggaran Harus Diisi',
                    'txtTA.numeric'             => 'Kolom Tahun Anggaran Harus Angka',
                    'txtMataAnggaran.required'  => 'Kolom Mata Anggaran Harus Diisi',
                    'txtSkRektor.required'      => 'Kolom Nomor SK. Rektor Harus Diisi',
                    'txtTanggalSK.required'     => 'Kolom Tanggal SK Harus Diisi',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtTA'                     => 'required',
                    'txtTA'                     => 'numeric',
                    'txtMataAnggaran'           => 'required',
                    'txtSkRektor'               => 'required',
                    'txtTanggalSK'              => 'required',
                ],$message);

                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                $query_smt = DB::table('vakasi')
                            ->join('semester','vakasi.id_smt','=','semester.id_smt')
                            ->select('semester.*')->first();

                $query_perangkat = VakasiDetail::with('vakasi')->where('id_vakasi','=',$request->id)->first();

                        //$phpWord = new \PhpOffice\PhpWord\PhpWord();
                $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('amprah.docx'));
                $template->setValue('ta',$request['txtTA']);
                $template->setValue('mak',$request['txtMataAnggaran']);
                $template->setValue('no_sk', $request['txtSkRektor']);
                $template->setValue('tgl_sk', $this->tanggal_indonesia($request['txtTanggalSK']));

                
                //Header
                $nm_smt = substr($query_smt->id_smt,4);
                if($nm_smt == '1') {
                    $smt = 'Ganjil';
                } else {
                    $smt = 'Genap';
                }

                $tak = substr($query_smt->id_smt,0,4);
                $nm_tak = $tak.'/'.$tak+1;
                $template->setValue('smt', $smt);
                $template->setValue('tak',$nm_tak);

                //Tanda Tangan
                $template->setValue('nm_ppk_rm',$query_perangkat->vakasi->nm_ppk_rm);
                $template->setValue('nip_ppk_rm',$query_perangkat->vakasi->nip_ppk_rm);
                $template->setValue('nm_ben',$query_perangkat->vakasi->nm_bp);
                $template->setValue('nip_ben',$query_perangkat->vakasi->nip_bp);
                $template->setValue('nm_bpp',$query_perangkat->vakasi->nm_bpp_rm);
                $template->setValue('nip_bpp',$query_perangkat->vakasi->nip_bpp_rm);
                $template->setValue('nm_dkn',$query_perangkat->vakasi->nm_dkn);
                $template->setValue('nip_dkn',$query_perangkat->vakasi->nip_dkn);

                //Query BAD Dosen
                $query_amprah = DB::table('vakasi_detail')
                // ->join('vakasi','vakasi.id','=','vakasi_detail.id_vakasi')
                ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                ->join('setting','setting.fungsional','=','fungsional.id')
                ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                         'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                         'dosenlb.npwp','dosenlb.no_rek','setting.a_ajr',DB::raw('sum(vakasi_detail.sks_mk) as SKS'),
                         DB::raw('setting.a_ajr*sum(vakasi_detail.sks_mk)*15 as TOT'),
                         DB::raw('(setting.a_ajr*sum(vakasi_detail.sks_mk)*15)*5/100 AS PPH'),
                         DB::raw('setting.a_ajr*sum(vakasi_detail.sks_mk)*15-((setting.a_ajr*sum(vakasi_detail.sks_mk)*15)*5/100) AS JLM')
                )
                ->where([['vakasi_detail.id_vakasi','=',$request->id],['vakasi_detail.mhs','!=','NULL']])
                ->groupBy('dosenlb.nup_nidn','setting.a_ajr')
                ->get();

                $jlh = count($query_amprah);

                $template->cloneRow('no', $jlh);
                //$template->cloneRow('n', $jlh);
                $i = 1;
                foreach ($query_amprah as $key => $item) {
                    $template->setValue('no#'.$i,$i);
                    //$template->setValue('n#'.$i,$i);
                    $template->setValue('nm_dsn_lb#'.$i,$this->namaDosenLB($item->glr_dpn,$item->name,$item->glr_blk));
                    $template->setValue('pgkt#'.$i,$item->pangkat);
                    $template->setValue('fngs#'.$i,$item->jbtn_fungsional);
                    $template->setValue('nm_dsn_lb_rek#'.$i,$item->name_no_rek);
                    $template->setValue('no_rek#'.$i,$item->no_rek);
                    $template->setValue('npwp#'.$i,$item->npwp);
                    $template->setValue('honor#'.$i,number_format($item->a_ajr,0,',','.'));
                    $template->setValue('sks#'.$i,$item->SKS);
                    $template->setValue('x#'.$i,'X');
                    $template->setValue('ttm#'.$i,'15');
                    $template->setValue('tot#'.$i,number_format($item->TOT,0,',','.'));
                    $template->setValue('pph_21#'.$i,number_format($item->PPH,0,',','.'));
                    $template->setValue('jum#'.$i,number_format($item->JLM,0,',','.'));
                    $i++;
                }

                $filename       = 'Amprah.docx';
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$filename);
                // $template->saveAs('php://output');
                $template->saveAs(storage_path("app/public/".$filename));
                return response()->json('OK',200);

        } catch (\Throwable $th) {
            throw $th;
        }          //return redirect()->route('405');
    }

    public function printBuatSoal(Request $request)
    {
        try {
            $message = [
                'txtTASoal.required'            => 'Kolom Tahun Anggaran Harus Diisi',
                'txtTASoal.numeric'             => 'Kolom Tahun Anggaran Harus Angka',
                'txtMataAnggaranSoal.required'  => 'Kolom Mata Anggaran Harus Diisi',
                'txtSkRektorSoal.required'      => 'Kolom Nomor SK. Rektor Harus Diisi',
                'txtTanggalSKSoal.required'     => 'Kolom Tanggal SK Harus Diisi',
            ];
    
            $validator =  Validator::make($request->all(), [
                'txtTASoal'                     => 'required',
                'txtTASoal'                     => 'numeric',
                'txtMataAnggaranSoal'           => 'required',
                'txtSkRektorSoal'               => 'required',
                'txtTanggalSKSoal'              => 'required',
            ],$message);

            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            $query_smt = DB::table('vakasi')
                        ->join('semester','vakasi.id_smt','=','semester.id_smt')
                        ->select('semester.*')->first();

            $query_perangkat = VakasiDetail::with('vakasi')->where('id_vakasi','=',$request->id_ps)->first();

            //$phpWord = new \PhpOffice\PhpWord\PhpWord();
            $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('amprah-mengawas.docx'));
            $template->setValue('ta',$request['txtTASoal']);
            $template->setValue('mak',$request['txtMataAnggaranSoal']);
            $template->setValue('no_sk', $request['txtSkRektorSoal']);
            $template->setValue('tgl_sk', $this->tanggal_indonesia($request['txtTanggalSKSoal']));

            
            //Header
            $nm_smt = substr($query_smt->id_smt,4);
            if($nm_smt == '1') {
                $smt = 'Ganjil';
            } else {
                $smt = 'Genap';
            }

            $tak = substr($query_smt->id_smt,0,4);
            $nm_tak = $tak.'/'.$tak+1;
            $template->setValue('smt', $smt);
            $template->setValue('tak',$nm_tak);

            //Tanda Tangan
            $template->setValue('nm_ppk',$query_perangkat->vakasi->nm_ppk);
            $template->setValue('nip_ppk',$query_perangkat->vakasi->nip_ppk);
            $template->setValue('nm_ben',$query_perangkat->vakasi->nm_bp);
            $template->setValue('nip_ben',$query_perangkat->vakasi->nip_bp);
            $template->setValue('nm_dkn',$query_perangkat->vakasi->nm_dkn);
            $template->setValue('nip_dkn',$query_perangkat->vakasi->nip_dkn);

            //Query Pembuat Soal
            $query_buat_soal = DB::table('vakasi_detail')
                                ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                                ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                                ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                                ->join('setting','setting.fungsional','=','fungsional.id')
                                ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                'dosenlb.npwp','dosenlb.no_rek','setting.a_soal',DB::raw('count(vakasi_detail.kode_mk) as jlm_naskah'),
                                DB::raw('setting.a_soal*count(vakasi_detail.kode_mk) as jlm_honor'),
                                DB::raw('(setting.a_soal*count(vakasi_detail.kode_mk))*5/100 AS PPH'),
                                DB::raw('setting.a_soal*count(vakasi_detail.kode_mk)-(setting.a_soal*count(vakasi_detail.kode_mk))*5/100 AS JLM')
                                )
                                ->where([['vakasi_detail.id_vakasi','=',$request->id_ps],['vakasi_detail.mhs','!=','NULL']])
                                ->groupBy('dosenlb.nup_nidn','setting.a_soal')
                                ->get();

            $jlh = count($query_buat_soal);

            $template->cloneRow('no', $jlh);
            //$template->cloneRow('n', $jlh);
            $i = 1;
            foreach ($query_buat_soal as $key => $item) {
                $template->setValue('no#'.$i,$i);
                //$template->setValue('n#'.$i,$i);
                $template->setValue('nm_dsn_lb#'.$i,$this->namaDosenLB($item->glr_dpn,$item->name,$item->glr_blk));
                $template->setValue('pgkt#'.$i,$item->pangkat);
                $template->setValue('fngs#'.$i,$item->jbtn_fungsional);
                $template->setValue('nm_dsn_lb_rek#'.$i,$item->name_no_rek);
                $template->setValue('no_rek#'.$i,$item->no_rek);
                $template->setValue('npwp#'.$i,$item->npwp);
                $template->setValue('nskh#'.$i,$item->jlm_naskah);
                $template->setValue('hnr#'.$i,number_format($item->a_soal,0,',','.'));
                $template->setValue('tot#'.$i,number_format($item->jlm_honor,0,',','.'));
                $template->setValue('pph_21#'.$i,number_format($item->PPH,0,',','.'));
                $template->setValue('jum#'.$i,number_format($item->JLM,0,',','.'));
                $i++;
            }

            $filename       = 'Amprah-Mengawas.docx';
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            // $template->saveAs('php://output');
            $template->saveAs(storage_path("app/public/".$filename));
            return response()->json('OK',200);

    } catch (\Throwable $th) {
        throw $th;
    }
    }

    public function printPengawasUjian(Request $request)
    {
        try {
            $message = [
                'txtTAPengawas.required'            => 'Kolom Tahun Anggaran Harus Diisi',
                'txtTAPengawas.numeric'             => 'Kolom Tahun Anggaran Harus Angka',
                'txtMataAnggaranPengawas.required'  => 'Kolom Mata Anggaran Harus Diisi',
                'txtSkRektorPengawas.required'      => 'Kolom Nomor SK. Rektor Harus Diisi',
                'txtTanggalSKPengawas.required'     => 'Kolom Tanggal SK Harus Diisi',
            ];
    
            $validator =  Validator::make($request->all(), [
                'txtTAPengawas'                     => 'required|numeric',
                'txtMataAnggaranPengawas'           => 'required',
                'txtSkRektorPengawas'               => 'required',
                'txtTanggalSKPengawas'              => 'required',
            ],$message);

            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            $query_smt = DB::table('vakasi')
                        ->join('semester','vakasi.id_smt','=','semester.id_smt')
                        ->select('semester.*')->first();

            $query_perangkat = VakasiDetail::with('vakasi')->where('id_vakasi','=',$request->id_pu)->first();

            //$phpWord = new \PhpOffice\PhpWord\PhpWord();
            $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('amprah-mengawas.docx'));
            $template->setValue('ta',$request['txtTAPengawas']);
            $template->setValue('mak',$request['txtMataAnggaranPengawas']);
            $template->setValue('no_sk', $request['txtSkRektorPengawas']);
            $template->setValue('tgl_sk', $this->tanggal_indonesia($request['txtTanggalSKPengawas']));

            
            //Header
            $nm_smt = substr($query_smt->id_smt,4);
            if($nm_smt == '1') {
                $smt = 'Ganjil';
            } else {
                $smt = 'Genap';
            }

            $tak = substr($query_smt->id_smt,0,4);
            $nm_tak = $tak.'/'.$tak+1;
            $template->setValue('smt', $smt);
            $template->setValue('tak',$nm_tak);

            //Tanda Tangan
            $template->setValue('nm_ppk',$query_perangkat->vakasi->nm_ppk);
            $template->setValue('nip_ppk',$query_perangkat->vakasi->nip_ppk);
            $template->setValue('nm_ben',$query_perangkat->vakasi->nm_bp);
            $template->setValue('nip_ben',$query_perangkat->vakasi->nip_bp);
            $template->setValue('nm_dkn',$query_perangkat->vakasi->nm_dkn);
            $template->setValue('nip_dkn',$query_perangkat->vakasi->nip_dkn);

            //Query Pembuat Soal
            $query_mengawas_ujian = DB::table('vakasi_detail')
                              ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                              ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                              ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                              ->join('setting','setting.fungsional','=','fungsional.id')
                              ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                'dosenlb.npwp','dosenlb.no_rek','setting.a_aws',DB::raw('count(vakasi_detail.kode_mk) as jlm_naskah'),
                                DB::raw('setting.a_aws*count(vakasi_detail.kode_mk) as jlm_honor'),
                                DB::raw('(setting.a_aws*count(vakasi_detail.kode_mk))*5/100 AS PPH'),
                                DB::raw('setting.a_aws*count(vakasi_detail.kode_mk)-(setting.a_aws*count(vakasi_detail.kode_mk))*5/100 AS JLM')
                               )
                            ->where([['vakasi_detail.id_vakasi','=',$request->id_pu],['vakasi_detail.mhs','!=','NULL']])
                            ->groupBy('dosenlb.nup_nidn','setting.a_aws')
                            ->get();

            $jlh = count($query_mengawas_ujian);

            $template->cloneRow('no', $jlh);
            //$template->cloneRow('n', $jlh);
            $i = 1;
            foreach ($query_mengawas_ujian as $key => $item) {
                $template->setValue('no#'.$i,$i);
                //$template->setValue('n#'.$i,$i);
                $template->setValue('nm_dsn_lb#'.$i,$this->namaDosenLB($item->glr_dpn,$item->name,$item->glr_blk));
                $template->setValue('pgkt#'.$i,$item->pangkat);
                $template->setValue('fngs#'.$i,$item->jbtn_fungsional);
                $template->setValue('nm_dsn_lb_rek#'.$i,$item->name_no_rek);
                $template->setValue('no_rek#'.$i,$item->no_rek);
                $template->setValue('npwp#'.$i,$item->npwp);
                $template->setValue('hari#'.$i,$item->jlm_naskah);
                $template->setValue('hnr#'.$i,number_format($item->a_aws,0,',','.'));
                $template->setValue('tot#'.$i,number_format($item->jlm_honor,0,',','.'));
                $template->setValue('pph_21#'.$i,number_format($item->PPH,0,',','.'));
                $template->setValue('jum#'.$i,number_format($item->JLM,0,',','.'));
                $i++;
            }

            $filename       = 'Amprah-Mengawas.docx';
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            // $template->saveAs('php://output');
            $template->saveAs(storage_path("app/public/".$filename));
            return response()->json('OK',200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function printPemeriksaUjian(Request $request)
    {
        try {
            $message = [
                'txtTAPemeriksa.required'            => 'Kolom Tahun Anggaran Harus Diisi',
                'txtTAPemeriksa.numeric'             => 'Kolom Tahun Anggaran Harus Angka',
                'txtMataAnggaranPemeriksa.required'  => 'Kolom Mata Anggaran Harus Diisi',
                'txtSkRektorPemeriksa.required'      => 'Kolom Nomor SK. Rektor Harus Diisi',
                'txtTanggalSKPemeriksa.required'     => 'Kolom Tanggal SK Harus Diisi',
            ];
    
            $validator =  Validator::make($request->all(), [
                'txtTAPemeriksa'                     => 'required|numeric',
                'txtMataAnggaranPemeriksa'           => 'required',
                'txtSkRektorPemeriksa'               => 'required',
                'txtTanggalSKPemeriksa'              => 'required',
            ],$message);

            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            $query_smt = DB::table('vakasi')
                        ->join('semester','vakasi.id_smt','=','semester.id_smt')
                        ->select('semester.*')->first();

            $query_perangkat = VakasiDetail::with('vakasi')->where('id_vakasi','=',$request->id_ku)->first();

            //$phpWord = new \PhpOffice\PhpWord\PhpWord();
            $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('amprah-koreksi.docx'));
            $template->setValue('ta',$request['txtTAPemeriksa']);
            $template->setValue('mak',$request['txtMataAnggaranPemeriksa']);
            $template->setValue('no_sk', $request['txtSkRektorPengawas']);
            $template->setValue('tgl_sk', $this->tanggal_indonesia($request['txtTanggalSKPemeriksa']));

            //Header
            $nm_smt = substr($query_smt->id_smt,4);
            if($nm_smt == '1') {
                $smt = 'Ganjil';
            } else {
                $smt = 'Genap';
            }

            $tak = substr($query_smt->id_smt,0,4);
            $nm_tak = $tak.'/'.$tak+1;
            $template->setValue('smt', $smt);
            $template->setValue('tak',$nm_tak);

            //Tanda Tangan
            $template->setValue('nm_ppk',$query_perangkat->vakasi->nm_ppk);
            $template->setValue('nip_ppk',$query_perangkat->vakasi->nip_ppk);
            $template->setValue('nm_ben',$query_perangkat->vakasi->nm_bp);
            $template->setValue('nip_ben',$query_perangkat->vakasi->nip_bp);
            $template->setValue('nm_dkn',$query_perangkat->vakasi->nm_dkn);
            $template->setValue('nip_dkn',$query_perangkat->vakasi->nip_dkn);

            //Query Pemeriksa Soal
            $query_pemeriksa_ujian = DB::table('vakasi_detail')
                                    ->join('dosenlb','dosenlb.id','=','vakasi_detail.id_dsn')
                                    ->join('fungsional','fungsional.id','=','dosenlb.fungsional')
                                    ->join('pangkat','pangkat.id','=','dosenlb.pangkat')
                                    ->join('setting','setting.fungsional','=','fungsional.id')
                                    ->select('dosenlb.nup_nidn','dosenlb.name','dosenlb.glr_dpn','dosenlb.glr_blk','pangkat.pangkat',
                                        'pangkat.golongan','fungsional.jbtn_fungsional','dosenlb.name_no_rek',
                                        'dosenlb.npwp','dosenlb.no_rek','setting.a_krk',DB::raw('sum(vakasi_detail.mhs) as jlm_mhs'),
                                        DB::raw('setting.a_krk*sum(vakasi_detail.mhs) as jlm_honor'),
                                        DB::raw('(setting.a_krk*sum(vakasi_detail.mhs))*5/100 AS PPH'),
                                        DB::raw('setting.a_krk*sum(vakasi_detail.mhs)-(setting.a_krk*sum(vakasi_detail.mhs))*5/100 AS JLM')
                                        )
                                    ->where('vakasi_detail.id_vakasi','=',$request->id_ku)
                                    ->groupBy('dosenlb.nup_nidn','setting.a_krk')
                                    ->get();

            $jlh = count($query_pemeriksa_ujian);

            $template->cloneRow('no', $jlh);
            //$template->cloneRow('n', $jlh);
            $i = 1;
            foreach ($query_pemeriksa_ujian as $key => $item) {
                $template->setValue('no#'.$i,$i);
                //$template->setValue('n#'.$i,$i);
                $template->setValue('nm_dsn_lb#'.$i,$this->namaDosenLB($item->glr_dpn,$item->name,$item->glr_blk));
                $template->setValue('pgkt#'.$i,$item->pangkat);
                $template->setValue('fngs#'.$i,$item->jbtn_fungsional);
                $template->setValue('nm_dsn_lb_rek#'.$i,$item->name_no_rek);
                $template->setValue('no_rek#'.$i,$item->no_rek);
                $template->setValue('npwp#'.$i,$item->npwp);
                $template->setValue('mhs#'.$i,$item->jlm_mhs);
                $template->setValue('hnr#'.$i,number_format($item->a_krk,0,',','.'));
                $template->setValue('tot#'.$i,number_format($item->jlm_honor,0,',','.'));
                $template->setValue('pph_21#'.$i,number_format($item->PPH,0,',','.'));
                $template->setValue('jum#'.$i,number_format($item->JLM,0,',','.'));
                $i++;
            }

            $filename       = 'Amprah-Koreksi.docx';
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            // $template->saveAs('php://output');
            $template->saveAs(storage_path("app/public/".$filename));
            return response()->json('OK',200);


        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function tanggal_indonesia($tgl,$tampil_hari=true)
    {
        $nama_hari  = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
        $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'];

        $tahun      = substr($tgl,0,4);
        $bulan      = $nama_bulan[(int)substr($tgl,5,2)-1];
        $tanggal    = substr($tgl,8,2);

        $text = "";

        if($tampil_hari) {
            $urutaan_hari = date('w',mktime(0,0,0, substr($tgl,5,2),$tanggal,$tahun));
            $hari  = $nama_hari[$urutaan_hari];
            // $text .= $hari.", ";
        }

        $text   .= $tanggal ." ". $bulan ." ". $tahun;
        return $text;
    }

    public function namaDosenLB($glrDpn,$nama,$glrBlk)
    {
        if ($glrDpn === NULL) {
            return ucwords($nama).'. '.$glrBlk;
        } elseif ($glrBlk === NULL) {
            return $glrDpn.'. '.ucwords($nama);
        } elseif ($glrDpn !=NULL && $glrBlk !=NULL) {
            return $glrDpn.'. '.ucwords($nama).'. '.$glrBlk;
        } else {
            return ucwords($nama);
        }
    }
}