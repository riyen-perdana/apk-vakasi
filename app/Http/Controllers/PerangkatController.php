<?php

namespace App\Http\Controllers;

use App\Enums\JabatanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Perangkat;

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
        //
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
