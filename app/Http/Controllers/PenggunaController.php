<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Pengguna"]];
        $roles = Role::all();
        return view('/content/apps/pengguna/index', ['breadcrumbs' => $breadcrumbs, 'roles'=>$roles]);
    }

    /**
     * Data Pengguna
     * @param void
     * @return @return \Illuminate\Http\Response
     */
    public function getDataPengguna()
    {
        try {

            DB::beginTransaction();
            $query = User::all();
            $data = ['data'=>$query];
            DB::commit();

            return response()->json($data,200);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th,500);
        }
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
                    'txtNIP.required'          => 'Kolom Nomor Induk Pegawai Wajib Diisi',
                    'txtNIP.unique'            => 'Nomor Induk Pegawai Sudah Ada, Isikan Yang Lain',
                    'txtNIP.numeric'           => 'Kolom Nomor Induk Pegawai Harus Angka',
                    'txtNama.required'         => 'Kolom Nama Pegawai Wajib Diisi',
                    'password.required'        => 'Kolom Kata Sandi Wajib Diisi',
                    'password.confirmed'       => 'Kolom Kata Kunci Tidak Cocok',
                    'txtEmail.email'           => 'Format E-mail Salah',
                    'txtEmail.required'        => 'Kolom E-mail Wajib Diisi',
                    'txtEmail.unique'          => 'E-mail Sudah Ada, Isikan Yang Lain',
                    'optStatus.required'       => 'Kolom Status Harus Dipilih',
                    'optRole.required'         => 'Kolom Role Harus Dipilih'
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtNIP'    => 'required|numeric|unique:users,nip',
                    'txtNama'   => 'required',
                    'password'  => 'required|confirmed',
                    'txtEmail'  => 'email|required|unique:users,email',
                    'optStatus' => 'required',
                    'optRole'   => 'required'
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = new User();
                $query->code_red    = Str::random(30);
                $query->nip         = $request['txtNIP'];
                $query->name        = $request['txtNama'];
                $query->glr_dpn     = $request['txtGlrDpn'];
                $query->glr_blk     = $request['txtGlrBlk'];
                $query->password     = Hash::make($request['password']);
                $query->email       = $request['txtEmail'];
                $query->is_aktif    = $request['optStatus'];
                $query->save();

                $query->syncRoles($request->optRole);

                DB::commit();

                return response()->json('true',200);

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
        $query = User::with('roles')->where('code_red',$id)->first();
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
                    'txtNIP.required'          => 'Kolom Nomor Induk Pegawai Wajib Diisi',
                    'txtNIP.unique'            => 'Nomor Induk Pegawai Sudah Ada, Isikan Yang Lain',
                    'txtNIP.numeric'           => 'Kolom Nomor Induk Pegawai Harus Angka',
                    'txtNama.required'         => 'Kolom Nama Pegawai Wajib Diisi',
                    'password.required'        => 'Kolom Kata Sandi Wajib Diisi',
                    'password.confirmed'       => 'Kolom Kata Kunci Tidak Cocok',
                    'txtEmail.email'           => 'Format E-mail Salah',
                    'txtEmail.required'        => 'Kolom E-mail Wajib Diisi',
                    'txtEmail.unique'          => 'E-mail Sudah Ada, Isikan Yang Lain',
                    'optStatus.required'       => 'Kolom Status Harus Dipilih',
                    'optRole.required'         => 'Kolom Role Harus Dipilih'
                ];
        
                $validator =  Validator::make($request->all(), [
                    'txtNIP'    => 'required|numeric|unique:users,nip,'.$id.',code_red',
                    'txtNama'   => 'required',
                    'password'  => 'nullable|confirmed,'.$id.',code_red',
                    'txtEmail'  => 'email|required|unique:users,email,'.$id.',code_red',
                    'optStatus' => 'required',
                    'optRole'   => 'required'
                ],$message);
        
                if ($validator->fails()) {
                    $pesan = $validator->messages();
                    return response()->json($pesan,500);
                }

                DB::beginTransaction();
                $query = User::where('code_red',$id)->first();
                $query->code_red    = Str::random(30);
                $query->nip         = $request['txtNIP'];
                $query->name        = $request['txtNama'];
                $query->glr_dpn     = $request['txtGlrDpn'];
                $query->glr_blk     = $request['txtGlrBlk'];

                if(!empty($request->password)) {
                    $query->password     = Hash::make($request['password']);
                }
                
                $query->email       = $request['txtEmail'];
                $query->is_aktif    = $request['optStatus'];
                $query->update();

                $query->syncRoles($request->optRole);

                DB::commit();

                return response()->json('true',200);

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
                $query = User::where('code_red',$id)->first();

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
