<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Fungsional;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Setting Vakasi"]];
        $fungsional = Fungsional::orderBy('jbtn_fungsional','ASC')->get();
        return view('/content/apps/setting/index', ['breadcrumbs' => $breadcrumbs,'fungsional'=> $fungsional]);
    }

    /**
     * Fungsi Get Data Setting Vakasi
     * @param 
     */
    public function getDataSetting()
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Setting::with('fungsional')->get();
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $message = [
                'optFungsional.required'   => 'Kolom Jabatan Fungsional Harus Diisi',
                'optFungsional.unique'     => 'Honor Jabatan Fungsional Sudah Ada, Pilih Yang Lain',
                'txt_a_ajr.required'       => 'Kolom Honorarium Mengajar Harus Diisi',
                'txt_a_soal.required'      => 'Kolom Honorarium Membuat Soal Harus Diisi',
                'txt_a_aws.required'       => 'Kolom Honorarium Pengawas Harus Diisi',
                'txt_a_krk.required'       => 'Kolom Honorarium Pengoreksi Soal Harus Diisi'
            ];
    
            $validator =  Validator::make($request->all(), [
                'optFungsional'    => 'required|unique:setting,fungsional',
                'txt_a_ajr'        => 'required',
                'txt_a_soal'       => 'required',
                'txt_a_aws'        => 'required',
                'txt_a_krk'        => 'required',
            ],$message);
    
            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            try {
                
                DB::beginTransaction();
                $query              = new Setting();
                $query->fungsional  = $request['optFungsional'];
                $query->a_ajr       = str_replace(",", "", $request['txt_a_ajr']);
                $query->a_soal      = str_replace(",", "", $request['txt_a_soal']);
                $query->a_aws       = str_replace(",", "", $request['txt_a_aws']);
                $query->a_krk       = str_replace(",", "", $request['txt_a_krk']);
                $query->save();

                DB::commit();

                return response()->json($query,200);


            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
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
        //
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
        $query = Setting::with('fungsional')->where('id','=',$id)->first();
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

            $message = [
                'optFungsional.required'   => 'Kolom Jabatan Fungsional Harus Diisi',
                'optFungsional.unique'     => 'Honor Jabatan Fungsional Sudah Ada, Pilih Yang Lain',
                'txt_a_ajr.required'       => 'Kolom Honorarium Mengajar Harus Diisi',
                'txt_a_soal.required'      => 'Kolom Honorarium Membuat Soal Harus Diisi',
                'txt_a_aws.required'       => 'Kolom Honorarium Pengawas Harus Diisi',
                'txt_a_krk.required'       => 'Kolom Honorarium Pengoreksi Soal Harus Diisi'
            ];
    
            $validator =  Validator::make($request->all(), [
                'optFungsional'    => 'required|unique:setting,fungsional,'.$id.',id',
                'txt_a_ajr'        => 'required',
                'txt_a_soal'       => 'required',
                'txt_a_aws'        => 'required',
                'txt_a_krk'        => 'required',
            ],$message);
    
            if ($validator->fails()) {
                $pesan = $validator->messages();
                return response()->json($pesan,500);
            }

            try {
                
                DB::beginTransaction();
                $query              = Setting::findOrFail($id);
                $query->a_ajr       = str_replace(",", "", $request['txt_a_ajr']);
                $query->a_soal      = str_replace(",", "", $request['txt_a_soal']);
                $query->a_aws       = str_replace(",", "", $request['txt_a_aws']);
                $query->a_krk       = str_replace(",", "", $request['txt_a_krk']);
                $query->update();

                DB::commit();

                return response()->json($query,200);


            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th,500);
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
                $query = Setting::where('id','=',$id)->first();

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
}
