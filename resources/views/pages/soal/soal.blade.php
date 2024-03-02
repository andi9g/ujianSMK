@extends('layouts.admin')

@section('judul', "SOAL UJIAN")
@section('soalActive', 'active')

@section('key')
<div id="tambahujian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Tambah Data Ujian</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambah.ujian', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class='form-group'>
                        <label for='fornamaujian' class='text-capitalize'>Nama Ujian</label>
                        <input type='text' name='namaujian' id='fornamaujian' class='form-control' placeholder='contoh : UJIAN AKHIR SEKOLAH (US)'>
                    </div>
    
                    <div class="form-row">
                        <div class="col-12">
                            <label for="tahunawal">Tahun Awal</label>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <select id="tahunawal" class="form-control" name="tahunawal">
                                    
                                    @for ($i=(date("Y") -2);$i < (date("Y") + 1); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <h4>/</h4>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <select id="tahunakhir" class="form-control" name="tahunakhir">
                                    @for ($i=(date("Y") -2);$i < (date("Y") + 1); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahujian">Tambah Ujian</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    @foreach ($ujian as $item)
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-bold">
                <ul>
                    <li>
                        <b>
                            {{ $item->namaujian }}
                        </b>
                    </li>
                    <li>
                        TP.{{ $item->tahunawal."/".$item->tahunakhir }}
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('soal', [$item->idujian]) }}" class="btn btn-block btn-success">
                    KELOLA
                </a>
            </div>
        </div>
            
    </div>
    @endforeach
    

</div>
@endsection