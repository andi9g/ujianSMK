<?php

namespace App\Http\Controllers;

use App\Models\soalM;
use App\Models\durasiM;
use App\Models\urutanM;
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
        $tanggal = date("Y-m-d H:i:s", strtotime("-4 minutes", strtotime(date("Y-m-d H:i:s"))));
        $sekarang = date("Y-m-d");

        $durasi = durasiM::first();

        $jamawal = soalM::where("tanggal", "like", "$sekarang%")->orderBy('tanggal', "asc")->first();
        $jamakhir = soalM::where("tanggal", "like", "$sekarang%")->orderBy('tanggal', "desc")->first();

        $soal = soalM::where("tanggal", "<=", "$tanggal")
        ->where("tanggal", "like", "$sekarang%")
        ->orderBy("tanggal", "desc")
        ->get();

        return view('pages.umum.umum', [
            "soal" => $soal,
            "jamawal" => $jamawal,
            "jamakhir" => $jamakhir,
            "durasi" => $durasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ujian(Request $request, $idsoal)
    {
        $request->validate([
            'nomorurut'=>'required',
        ],[
            "nomorurut.required" => "Nomor Ujian tidak boleh kosong!"
        ]);

        try{
            // $idsoal = $idsoal;
            $soal = soalM::where("idsoal", $idsoal)->first();

            $urutan = urutanM::where("nomorurut", $request->nomorurut)
            ->where("idujian", $soal->idujian)->count();


            if ($urutan == 0) {
                return redirect()->back()->with('error', 'Maaf nomor ujian tidak terdaftar');
            }

            $links = $soal->links;
            return redirect()->away($links);

        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
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
