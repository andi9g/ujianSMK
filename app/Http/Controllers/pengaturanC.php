<?php

namespace App\Http\Controllers;

use App\Models\durasiM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $durasi = durasiM::first();
        return view("pages.pengaturan.durasi", [
            "durasi" => $durasi,
        ]);
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
     * @param  \App\Models\durasiM  $durasiM
     * @return \Illuminate\Http\Response
     */
    public function show(durasiM $durasiM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\durasiM  $durasiM
     * @return \Illuminate\Http\Response
     */
    public function edit(durasiM $durasiM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\durasiM  $durasiM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, durasiM $durasiM, $iddurasi)
    {
        $request->validate([
            'nilai'=>'required|numeric',
            'durasi'=>'required',
        ]);

        try{
            $data = $request->all();
            durasiM::where("iddurasi", $iddurasi)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\durasiM  $durasiM
     * @return \Illuminate\Http\Response
     */
    public function destroy(durasiM $durasiM)
    {
        //
    }
}
