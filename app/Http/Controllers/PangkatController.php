<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pangkat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Pangkat Golongan"]];
        return view('/content/apps/pangkat/index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * getDataPangakt
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getDataPangkat()
    {
        if (request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Pangkat::orderBy('pangkat','asc')->get();
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
        return redirect()->route('error');
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
                    'txtPangkat.required'   => 'Kolom Pangkat Wajib Diisi',
                    'txtGolongan.required'  => 'Kolom Golongan Wajib Diisi',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtPangkat'    => 'required',
                    'txtGolongan'   => 'required',
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = new Pangkat();
                $query->pangkat     = $request['txtPangkat'];
                $query->golongan    = $request['txtGolongan'];
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
        $query = Pangkat::where('id',$id)->first();
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
                    'txtPangkat.required'   => 'Kolom Pangkat Wajib Diisi',
                    'txtGolongan.required'  => 'Kolom Golongan Wajib Diisi',
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtPangkat'    => 'required',
                    'txtGolongan'   => 'required',
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = Pangkat::where('id',$id)->first();
                $query->pangkat     = $request['txtPangkat'];
                $query->golongan    = $request['txtGolongan'];
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
                $query = Pangkat::where('id',$id)->first();

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
