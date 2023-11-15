<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fungsional;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Jabatan Fungsional"]];
        return view('/content/apps/fungsional/index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * getDataFungsional
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getDataFungsional()
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Fungsional::orderBy('jbtn_fungsional','asc')->get();
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

            try {

                $message = [
                    'txtFungsional.required'        => 'Kolom Jabatan Fungsional Wajib Diisi',
                    'txtAmprahMengajar.required'    => 'Kolom Besaran Amprah Mengajar Wajib Diisi',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtFungsional'     => 'required',
                    'txtAmprahMengajar' => 'required',
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = new Fungsional();
                $query->jbtn_fungsional     =  $request['txtFungsional'];
                $query->amprah              =  $request['txtAmprahMengajar'];
                $query->save();
                
                DB::commit();
                return response()->json('true',200);

            } catch (\Throwable $th) {
                //return $th;
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
        return redirect()->route('error');
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
        $query = Fungsional::where('id',$id)->first();
        echo json_encode($query);
        DB::commit();
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
                    'txtFungsional.required'        => 'Kolom Jabatan Fungsional Wajib Diisi',
                    'txtAmprahMengajar.required'    => 'Kolom Besaran Amprah Mengajar Wajib Diisi',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtFungsional'     => 'required',
                    'txtAmprahMengajar' => 'required',
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = Fungsional::where('id',$id)->first();
                $query->jbtn_fungsional     =  $request['txtFungsional'];
                $query->amprah              =  $request['txtAmprahMengajar'];
                $query->update();
                
                DB::commit();
                return response()->json('true',200);

            } catch (\Throwable $th) {
                //return $th;
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
                $query = Fungsional::where('id',$id)->first();

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
