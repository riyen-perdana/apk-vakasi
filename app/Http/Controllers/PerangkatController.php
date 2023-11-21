<?php

namespace App\Http\Controllers;

use App\Enums\JabatanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Perangkat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Perangkat"]];
        return view('/content/apps/perangkat/index', ['breadcrumbs' => $breadcrumbs,'jabatan' => JabatanStatus::cases()]);
    }

    /**
     * Get Data Perangkat
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getDataPerangkat()
    {
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Perangkat::all();
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
                    'txtNIP.required'                   => 'Kolom Nomor Induk Pegawai Wajib Diisi',
                    'txtNIP.unique'                     => 'Kolom Nomor Induk Pegawai Sudah Ada',
                    'txtNama.required'                  => 'Kolom Nama Perangkat Wajib Diisi',
                    'optPlt.required'                   => 'Kolom Status PLT Wajib Diisi',
                    'optJabatan.required'               => 'Kolom Jabatan Wajib Diisi',
                    'optStatus.required'                => 'Kolom Status Aktif Wajib Diisi',
                    'txtAwalJabatan.required'           => 'Kolom Awal Jabatan harus diisi',
                    'txtAkhirJabatan.required'          => 'Kolom Akhir Jabatan harus diisi',
                    'txtAkhirJabatan.after_or_equal'    => 'Tanggal Akhir Jabatan harus lebih dari Tanggal Awal Jabatan',
                ];

                $validator =  Validator::make($request->all(), [
                    'txtNIP'            => ['required',
                                            function ($attribute, $value, $fail) {
                                                $pegawai = Perangkat::where([['nip','=',$value],['is_aktif','=','Y']])->first();
                                                if ($pegawai) {
                                                    $fail('Kolom Nomor Induk Pegawai Dengan Status Aktif Sudah Ada');
                                                }
                                            },
                                        ],
                    'txtNama'           => 'required',
                    'optPlt'            => 'required',
                    'optJabatan'        => 'required',
                    'optStatus'         => 'required',
                    'txtAwalJabatan'    => 'required',
                    'txtAkhirJabatan'   => 'required|after_or_equal:txtAwalJabatan',
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                //Cari Data Dengan Nilai Yang Sama, Jika Ada Ubah Data Menjadi Tidak Aktif
                $perangkat = Perangkat::where([['nip',$request['txtNIP']],['is_jabatan',$request['optJabatan']],['is_aktif',$request['optStatus']]]);

                DB::beginTransaction();

                if($perangkat) {
                    //Update Data Tersebut Menjadi Tidak Aktif
                    $perangkat->is_jabatan = 'N';
                    $perangkat->update();
                }


                $query = new Perangkat();
                $query->nip     = $request['txtNIP'];
                $query->nama    = $request['txtNama'];
                $query->glr_dpn = $request['txtGlrDpn'];
                $query->glr_blk = $request['txtGlrBlk'];
                $query->is_jabatan = $request['optJabatan'];
                $query->is_plt  = $request['optPlt'];
                $query->is_aktif = $request['optStatus'];
                $query->awal_jabatan  = $request['txtAwalJabatan'];
                $query->akhir_jabatan = $request['txtAkhirJabatan'];
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
        if(request()->ajax()) {
            try {
                DB::beginTransaction();
                $query = Perangkat::findOrFail($id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            DB::beginTransaction();
            $query = Perangkat::findOrFail($id);
            DB::commit();
            echo json_encode($query);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($th,500);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
