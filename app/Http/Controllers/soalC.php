<?php

namespace App\Http\Controllers;

use App\Models\soalM;
use App\Models\ujianM;
use App\Models\jurusanM;
use App\Models\kelasM;
use Illuminate\Http\Request;

class soalC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ujian = ujianM::get();
        
        return view("pages.soal.soal", [
            "ujian" => $ujian,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kelola(Request $request, $idujian)
    {
        $kelas = kelasM::get();
        $jurusan = jurusanM::get();
        
        

        $keyword = empty($request->keyword)?'':$request->keyword;

        $soal = soalM::where("mapel", "like", "%$keyword%")
        ->orderBy("mapel", "asc")
        ->paginate(20);

        $soal->appends($request->only(["limit", "keyword"]));

        return view("pages.soal.kelola", [
            "kelas" => $kelas,
            "jurusan" => $jurusan,
            "idujian" => $idujian,
            "keyword" => $keyword,
            "soal" => $soal,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $tanggal = $request->tanggal." ".$request->jam.":00";
            $data['tanggal'] = date("Y-m-d H:i:s", strtotime($tanggal));
            
            $jurusan = "";
            $i = 1;
            foreach ($request->jurusan as $j) {
                $jurusan = $jurusan.$j.(($i==count($request->jurusan))?'':",");
                $i++;
            }

            $data["jurusan"] = $jurusan;

            soalM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
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
    public function update(Request $request, soalM $soalM, $idsoal)
    {
        try{
            $data = $request->all();
            $tanggal = $request->tanggal." ".$request->jam.":00";
            $data['tanggal'] = date("Y-m-d H:i:s", strtotime($tanggal));

            $jurusan = "";
            $i = 1;
            foreach ($request->jurusan as $j) {
                $jurusan = $jurusan.$j.(($i==count($request->jurusan))?'':",");
                $i++;
            }

            $data["jurusan"] = $jurusan;

            soalM::where("idsoal", $idsoal)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\soalM  $soalM
     * @return \Illuminate\Http\Response
     */
    public function destroy(soalM $soalM, $idsoal)
    {
        try{
            soalM::destroy($idsoal);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
