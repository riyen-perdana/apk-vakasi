<?php

namespace App\Http\Controllers;

use App\Dosenlb;
use Illuminate\Http\Request;
use App\Pangkat;
use App\Fungsional;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DosenlbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Dosen Luar Biasa"]];
        $pangkat = Pangkat::orderBy('pangkat','ASC')->get();
        $fungsional = Fungsional::orderBy('jbtn_fungsional','ASC')->get();
        return view('/content/apps/dosenlb/index', ['breadcrumbs' => $breadcrumbs,'pangkat'=> $pangkat, 'fungsional' => $fungsional]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('405');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->ajax()) {

            try {
                
                $message = [
                    'txtNUPNIDN.required'      => 'Kolom NUP/NIDN Harus Diisi',
                    'txtNUPNIDN.numeric'       => 'Kolom NUP/NIDN Harus Angka',
                    'txtNUPNIDN.digits'        => 'Panjang Digit NUP/NIDN 10 Angka',
                    'txtNUPNIDN.inique'        => 'NUP/NIDN Sudah Ada, Isikan Yang Lain',
                    'txtNamaDsnLb.required'    => 'Kolom Nama Dosen Luar Biasa Harus Diisi',
                    'txtNPWP.required'         => 'Kolom Nomor Pokok Wajib Pajak Harus Diisi',
                    'txtNPWP.regex'            => 'Format Kolom Nomor Pokok Wajib Pajak Salah',
                    'txtNoRek.required'        => 'Kolom Nomor Rekening Bank Harus Diisi',
                    'txtNoRek.numeric'         => 'Kolom Nomor Rekening Bank Harus Angka',
                    'txtNoRek.unique'          => 'Kolom Nomor Rekening Sudah Ada, Isikan Yang Lain',
                    'txtNamaNoRek.required'    => 'Kolom Nama Sesuai Nomor Rekening Harus Diisi',
                    'optPangkat.required'      => 'Kolom Pangkat dan Golongan Harus Dipilih',
                    'optJafung.required'       => 'Kolom Jabatan Fungsional Harus Dipilih',
                    'optStatus.required'       => 'Kolom Status Harus Dipilih',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtNUPNIDN'    => 'required|numeric|digits:10|unique:dosenlb,nup_nidn',
                    'txtNamaDsnLb'  => 'required',
                    'txtNPWP'       => 'required|regex:/^([\d]{2})[.]([\d]{3})[.]([\d]{3})[.][\d][-]([\d]{3})[.]([\d]{3})$/',
                    'txtNoRek'      => 'required|numeric|unique:dosenlb,no_rek',
                    'txtNamaNoRek'  => 'required',
                    'optPangkat'    => 'required',
                    'optJafung'     => 'required',
                    'optStatus'     => 'required'
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = new Dosenlb();
                $query->nup_nidn        = $request['txtNUPNIDN'];
                $query->glr_dpn         = $request['txtGlrDpn'];
                $query->glr_blk         = $request['txtGlrBlk'];
                $query->name            = $request['txtNamaDsnLb'];
                $query->npwp            = $request['txtNPWP'];
                $query->no_rek          = $request['txtNoRek'];
                $query->name_no_rek     = $request['txtNamaNoRek'];
                $query->pangkat         = $request['optPangkat'];
                $query->fungsional      = $request['optJafung'];
                $query->is_aktif        = $request['optStatus'];
                $query->save();

                DB::commit();

                return response()->json($query,200);

            } catch (\Throwable $th) {
                // DB::rollBack();
                // return response()->json($th,500);
                return $th;
            }
        }

        return redirect()->route('405');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->ajax()) {

            try {
                DB::beginTransaction();
                $query = Dosenlb::with(['pangkat','fungsional'])->where('id','=',$id)->first();
                DB::commit();
                return $query;
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json($th,500);
            }

        }

        return redirect()->route('405');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        $query = Dosenlb::where('id','=',$id)->first();
        DB::commit();
        echo json_encode($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(request()->ajax()) {

            try {
                
                $message = [
                    'txtNUPNIDN.required'      => 'Kolom NUP/NIDN Harus Diisi',
                    'txtNUPNIDN.numeric'       => 'Kolom NUP/NIDN Harus Angka',
                    'txtNUPNIDN.digits'        => 'Panjang Digit NUP/NIDN 10 Angka',
                    'txtNUPNIDN.inique'        => 'NUP/NIDN Sudah Ada, Isikan Yang Lain',
                    'txtNamaDsnLb.required'    => 'Kolom Nama Dosen Luar Biasa Harus Diisi',
                    'txtNPWP.required'         => 'Kolom Nomor Pokok Wajib Pajak Harus Diisi',
                    'txtNPWP.regex'            => 'Format Kolom Nomor Pokok Wajib Pajak Salah',
                    'txtNoRek.required'        => 'Kolom Nomor Rekening Bank Harus Diisi',
                    'txtNoRek.numeric'         => 'Kolom Nomor Rekening Bank Harus Angka',
                    'txtNoRek.unique'          => 'Kolom Nomor Rekening Sudah Ada, Isikan Yang Lain',
                    'txtNamaNoRek.required'    => 'Kolom Nama Sesuai Nomor Rekening Harus Diisi',
                    'optPangkat.required'      => 'Kolom Pangkat dan Golongan Harus Dipilih',
                    'optJafung.required'       => 'Kolom Jabatan Fungsional Harus Dipilih',
                    'optStatus.required'       => 'Kolom Status Harus Dipilih',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtNUPNIDN'    => 'required|numeric|digits:10|unique:dosenlb,nup_nidn,'.$id.',id',
                    'txtNamaDsnLb'  => 'required',
                    'txtNPWP'       => 'required|regex:/^([\d]{2})[.]([\d]{3})[.]([\d]{3})[.][\d][-]([\d]{3})[.]([\d]{3})$/',
                    'txtNoRek'      => 'required|numeric|unique:dosenlb,no_rek,'.$id.',id',
                    'txtNamaNoRek'  => 'required',
                    'optPangkat'    => 'required',
                    'optJafung'     => 'required',
                    'optStatus'     => 'required'
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = Dosenlb::findOrFail($id);
                $query->nup_nidn        = $request['txtNUPNIDN'];
                $query->glr_dpn         = $request['txtGlrDpn'];
                $query->glr_blk         = $request['txtGlrBlk'];
                $query->name            = $request['txtNamaDsnLb'];
                $query->npwp            = $request['txtNPWP'];
                $query->no_rek          = $request['txtNoRek'];
                $query->name_no_rek     = $request['txtNamaNoRek'];
                $query->pangkat         = $request['optPangkat'];
                $query->fungsional      = $request['optJafung'];
                $query->is_aktif        = $request['optStatus'];
                $query->update();

                DB::commit();

                return response()->json($query,200);

            } catch (\Throwable $th) {
                DB::rollBack();
                return $th;
                // return response()->json($th,500);
                //return response()->json($th,500);
            }
        }

        return redirect()->route('405');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->ajax()) {

            try {

                DB::beginTransaction();
                $query = Dosenlb::where('id','=',$id)->first();

                if($query) {
                    $query->delete();
                    DB::commit();
                    return response()->json($query,200);
                }

                DB::commit();
                return response()->json($query,500);
                
                
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
            }
        }

        return redirect()->route('405');
    }

    /**
     * Fungsi Ambil Data Dosen Luar Biasa
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getDataDosen()
    {
        if (request()->ajax()) {

            try {

                DB::beginTransaction();
                $query = Dosenlb::with(['pangkat','fungsional'])->get();
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

    public function testing()
    {
        return response()->json('haiiiii',200);
    }
}
