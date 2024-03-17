@extends('layouts.umum')
@php
    $ket["minutes"] = "Menit";
    $ket["hours"] = "Jam";
@endphp
@section('head')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

</style>
@endsection

@section('content')
<div class="card my-1">
    <div class="card-body py-1">
        <p class="text-success m-0 p-0 text-bold">
            <b>
                PERHATIAN
            </b>
        </p>
        <small class="m-0 p-0">
            Ujian pada
            @if (!empty($jamawal) || !empty($jamakhir))
            <b>{{ \Carbon\Carbon::parse(date("Y-m-d"))->isoFormat("dddd, DD MMMM Y") }}</b>
            diselenggarakan pada pukul
                <font class="text-success text-bold"><b>
                {{ date("H:i", strtotime($jamawal->tanggal)) }}
                s/d Selesai
                </b></font>

            @else
                <b>{{ \Carbon\Carbon::parse(date("Y-m-d"))->isoFormat("dddd, DD MMMM Y") }}</b>
                <font class="text-danger text-bold"><b>TIDAK ADA</b></font>
            @endif
            . Lakukan <b>Refresh Halaman</b> jika belum ada link ujian.
        </small> <br>
        <small class="text-danger">
            <i>
                Link ujian akan di tutup dalam waktu {{ $durasi->nilai }} {{ $ket["$durasi->durasi"] }} pada website
            </i>
        </small>
    </div>
</div>



@foreach ($soal as $item)

    @php
        $tanggal = strtotime(date("Y-m-d H:i:s", strtotime("+$durasi->nilai "."$durasi->durasi", strtotime($item->tanggal))));
        $sekarang = strtotime(date("Y-m-d H:i:s"));
        // dd($tanggal);

    @endphp

   @if ($tanggal > $sekarang)
   <div class="card mt-3">
        <div class="card-body ">
            <h4 class=" m-0 p-0">{{ $item->mapel }}
            </h4>
            <p class="card-text text-success m-0 p-0">
                <b>
                    TELAH DIBUKA

                </b>
            </p>
            <p class="card-text m-0 p-0">
                @php
                    $ex = explode(",", $item->jurusan);
                @endphp
                @foreach ($ex as $j)
                    <small class="badge badge-btn badge-success border-0 py-1">{{ $j }}</small>
                @endforeach
            </p>
            <div class="row mt-2">
                <div class="col-6">
                        <input type='text' id='passwordCopy{{ $item->idsoal }}' onclick="copyText{{ $item->idsoal }}()" class='form-control rounded-0 text-center' readonly style="border: 0;border-bottom:1px solid rgb(176, 176, 176);font-size:15pt" value="{{ $item->password }}">
                        <small onclick="copyText{{ $item->idsoal }}()"><i>clik password untuk copy</i></small>

                        <script>
                            function copyText{{ $item->idsoal }}() {
                                var textToCopy = document.getElementById("passwordCopy{{ $item->idsoal }}");
                                textToCopy.select();
                                document.execCommand("copy");
                                const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                                });
                                Toast.fire({
                                icon: "success",
                                title: "Text berhasil di COPY"
                                });
                            }
                        </script>

                </div>
                <div class="col-6">
                    <a href="{{ $item->links }}" target="_blank" class="btn btn-block btn-info m-0 rounded-lg btnku">
                        UJIAN SEKARANG
                    </a>
                </div>


            </div>
        </div>
    </div>

   @else
   <div class="card mt-3" style="background: rgba(228, 228, 228, 0.866)">
    <div class="card-body">
        <h5 class="card-title m-0 p-0">{{ $item->mapel }}
        </h5>
        <p class="card-text text-danger m-0 p-0">
            <b>TELAH DITUTUP</b>
        </p>
        <p class="card-text m-0 p-0">
            @php
                $ex = explode(",", $item->jurusan);
            @endphp
            @foreach ($ex as $j)
                <small class="badge badge-btn badge-success border-0 py-1">{{ $j }}</small>
            @endforeach
        </p>
    </div>
</div>

   @endif


@endforeach

@endsection
