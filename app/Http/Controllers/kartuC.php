<?php

namespace App\Http\Controllers;

use App\Models\siswaM;
use App\Models\ujianM;
use App\Models\jurusanM;
use App\Models\urutanM;
use App\Models\ruanganM;
use App\Models\kelasM;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class kartuC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kartu(Request $request)
    {
        $ujian = ujianM::orderBy("idujian", "desc")->get();
        return view("pages.kartu.ujian", [
            "ujian" => $ujian,
        ]);
    }

    public function tambahujian(Request $request)
    {
        try{
            $data = $request->all();
            ujianM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }

    }
    public function ubahujian(Request $request, $idujian)
    {
        try{
            $data = $request->all();
            ujianM::where("idujian", $idujian)->first()->update($data);
            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
    public function hapusujian(Request $request, $idujian)
    {
        ujianM::destroy($idujian);
        return redirect()->back()->with('success', 'Success');

    }

    public function index(Request $request, $idujian)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $kelas = empty($request->kelas)?'':$request->kelas;
        $jurusan = empty($request->jurusan)?'':$request->jurusan;

        $datajurusan = jurusanM::get();
        $datakelas = kelasM::get();
        $dataruangan = ruanganM::get();

        $siswa = siswaM::where("idkelas", "like", "$kelas%")
        ->where("idjurusan", "like", "$jurusan%")
        ->where("nama", "like", "%$keyword%")
        ->where("idkelas", "!=", "4")
        ->orderBy("nama", "ASC")
        ->orderBy("idkelas", "ASC")
        ->paginate(15);

        $siswa->appends($request->only(["keyword", "limit", "jurusan", "kelas"]));

        return view("pages.kartu.kartu", [
            "datakelas" => $datakelas,
            "keyword" => $keyword,
            "kelas" => $kelas,
            "siswa" => $siswa,
            "idujian" => $idujian,
            "dataruangan" => $dataruangan,
            "datajurusan" => $datajurusan,
            "jurusan" => $jurusan,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kirimurutan(Request $request, $idujian)
    {

        $nisn = sprintf("%010s",$request->nisn);

        $nomorurut = $request->nomorurut;
        $idruangan = $request->idruangan;

        try{

            if(empty($nomorurut) || empty($idruangan)) {
                $pesan = [
                    "success" => "error",
                    "message" => "Maaf inputan tidak boleh kosong",
                ];
                return $pesan;
            }

            $cek = urutanM::where("idujian", $idujian)->where("nisn", $nisn);

            if($cek->count() == 0) {
                $tambah = new urutanM;
                $tambah->nisn = $nisn;
                $tambah->idujian = $idujian;
                $tambah->nomorurut = $nomorurut;
                $tambah->idruangan = $idruangan;
                $tambah->save();
            }else {
                $cek->first()->update([
                    "nomorurut" => $nomorurut,
                    "idruangan" => $idruangan,
                ]);
            }
            $pesan = [
                "success" => "success",
                "message" => "Data berhasil di update",
            ];

            return $pesan;


        }catch(\Throwable $th){
            $pesan = [
                "success" => "error",
                "message" => "Terjadi kesalahan",
            ];
            return $pesan;
        }



    }

    public function hapusurutan(Request $request, $idujian)
    {

        $nisn = sprintf("%010s",$request->nisn);

        $nomorurut = $request->nomorurut;
        $idruangan = $request->idruangan;

        try{


            $cek = urutanM::where("idujian", $idujian)->where("nisn", $nisn);

            if($cek->count() == 0) {
            }else {
                $cek->first()->delete();
            }
            $pesan = [
                "success" => "success",
                "message" => "Data berhasil di update",
            ];

            return $pesan;


        }catch(\Throwable $th){
            $pesan = [
                "success" => "error",
                "message" => "Terjadi kesalahan",
            ];
            return $pesan;
        }



    }

    public function cetak(Request $request, $idujian)
    {

        $idruangan = empty($request->idruangan)?'':$request->idruangan;



        $data = urutanM::where("idruangan", "$idruangan%")
        ->where("idujian", $idujian)
        ->get();

        // $siswa = siswaM::where("idkelas", "like", "$kelas%")
        // ->where("nama", "like", "%$keyword%")
        // ->orderBy("idkelas", "ASC")
        // ->orderBy("nama", "ASC")
        // ->get();

        $pdf = PDF::LoadView("pages.kartu.cetak.kartu", [
            "idruangan" => $idruangan,
            "idujian" => $idujian,
            "data" => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("Kartu Ujian Ruangan ".$idruangan.".pdf");

    }

    public function meja(Request $request, $idujian)
    {

        $idruangan = empty($request->idruangan)?'':$request->idruangan;



        $data = urutanM::where("idruangan", "$idruangan%")
        ->where("idujian", $idujian)
        ->get();

        $ujian = ujianM::where("idujian", $idujian)->first();

        // $siswa = siswaM::where("idkelas", "like", "$kelas%")
        // ->where("nama", "like", "%$keyword%")
        // ->orderBy("idkelas", "ASC")
        // ->orderBy("nama", "ASC")
        // ->get();

        $pdf = PDF::LoadView("pages.kartu.cetak.meja", [
            "idruangan" => $idruangan,
            "idujian" => $idujian,
            "data" => $data,
            "ujian" => $ujian,
        ])->setPaper('a4');

        return $pdf->stream("Meja Ujian Ruangan ".$idruangan.".pdf");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cetakabsen(Request $request, $idujian)
    {
        $idruangan = empty($request->idruangan)?'':$request->idruangan;
        $pengawas = empty($request->pengawas)?1:$request->pengawas;


        $data = urutanM::where("idruangan", "$idruangan%")
        ->where("idujian", $idujian)
        ->orderBy("nomorurut", 'asc')
        ->get();


        // $siswa = siswaM::where("idkelas", "like", "$kelas%")
        // ->where("nama", "like", "%$keyword%")
        // ->orderBy("idkelas", "ASC")
        // ->orderBy("nama", "ASC")
        // ->get();

        $pdf = PDF::LoadView("pages.kartu.cetak.absen", [
            "idruangan" => $idruangan,
            "idujian" => $idujian,
            "data" => $data,
            "pengawas" => $pengawas,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("Absensi Ruangan ".$idruangan.".pdf");
    }
    public function cetakdaftarpeserta(Request $request, $idujian)
    {
        $idruangan = empty($request->idruangan)?'':$request->idruangan;
        $pengawas = empty($request->pengawas)?1:$request->pengawas;


        $data = urutanM::where("idruangan", "$idruangan%")
        ->where("idujian", $idujian)
        ->orderBy("nomorurut", 'asc')
        ->get();


        // $siswa = siswaM::where("idkelas", "like", "$kelas%")
        // ->where("nama", "like", "%$keyword%")
        // ->orderBy("idkelas", "ASC")
        // ->orderBy("nama", "ASC")
        // ->get();

        $pdf = PDF::LoadView("pages.kartu.cetak.daftarpeserta", [
            "idruangan" => $idruangan,
            "idujian" => $idujian,
            "data" => $data,
            "pengawas" => $pengawas,
        ])->setPaper('F4', 'portrait');

        return $pdf->stream("Absensi Ruangan ".$idruangan.".pdf");
    }

    public function cetakdenah(Request $request, $idujian)
    {

        $idruangan = empty($request->idruangan)?'':$request->idruangan;

        $ruangan = ruanganM::where("idruangan",$idruangan)->first();
        $baris = empty($request->baris)?4:$request->baris;
        $pengawas = empty($request->pengawas)?1:$request->pengawas;

        $data = urutanM::where("idruangan", "$idruangan%")
        ->where("idujian", $idujian)
        ->orderBy("nomorurut", 'asc')
        ->get();

        $ujian = ujianM::where("idujian", $idujian)->first();
        // $siswa = siswaM::where("idkelas", "like", "$kelas%")
        // ->where("nama", "like", "%$keyword%")
        // ->orderBy("idkelas", "ASC")
        // ->orderBy("nama", "ASC")
        // ->get();

        $pdf = PDF::LoadView("pages.kartu.cetak.denah", [
            "idruangan" => $idruangan,
            "ruangan" => $ruangan,
            "idujian" => $idujian,
            "data" => $data,
            "baris" => $baris,
            "pengawas" => $pengawas,
            "ujian" => $ujian,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("Cetak Denah Ruangan ".$idruangan.".pdf");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function show(siswaM $siswaM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function edit(siswaM $siswaM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswaM $siswaM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswaM $siswaM)
    {
        //
    }
}
