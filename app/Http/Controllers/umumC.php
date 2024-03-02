<?php

namespace App\Http\Controllers;

use App\Models\soalM;
use Illuminate\Http\Request;

class umumC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tanggal = date("Y-m-d H:i:s");
        $sekarang = date("Y-m-d");

        $jamawal = soalM::where("tanggal", "like", "$sekarang%")->orderBy('tanggal', "asc")->first();
        $jamakhir = soalM::where("tanggal", "like", "$sekarang%")->orderBy('tanggal', "desc")->first();

        $soal = soalM::where("tanggal", "<=", "$tanggal")
        ->get();

        return view('pages.umum.umum', [
            "soal" => $soal,
            "jamawal" => $jamawal,
            "jamakhir" => $jamakhir,
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
     * @param  \App\Models\soalM  $soalM
     * @return \Illuminate\Http\Response
     */
    public function show(soalM $soalM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\soalM  $soalM
     * @return \Illuminate\Http\Response
     */
    public function edit(soalM $soalM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\soalM  $soalM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, soalM $soalM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\soalM  $soalM
     * @return \Illuminate\Http\Response
     */
    public function destroy(soalM $soalM)
    {
        //
    }
}
