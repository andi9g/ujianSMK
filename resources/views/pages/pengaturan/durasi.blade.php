@extends('layouts.admin')

@section('pengaturanActive', "active")

@section('judul', "PENGATURAN")

@section('content')

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card my-0">
                <div class="card-header my-0 py-3">
                    <h3 class="my-0 py-0">DURASI</h3>
                </div>
                <form action="{{ route('pengaturan.update', [$durasi->iddurasi]) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nilai">Waktu (Angka)</label>
                            <input id="nilai" class="form-control" type="number" placeholder="masukan nilai" value="{{ $durasi->nilai }}" name="nilai">
                        </div>


                            <div class="form-group">
                                <label for="durasi">Durasi</label>
                                <select id="durasi" class="form-control" name="durasi">
                                    <option value="minutes" @if ($durasi->durasi == "minutes")
                                        selected
                                    @endif>Menit</option>
                                    <option value="hours" @if ($durasi->durasi == "hours")
                                        selected
                                    @endif>Jam</option>
                                </select>
                            </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
