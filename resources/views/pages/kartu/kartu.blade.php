@extends('layouts.admin')

@section('kartuActive', 'active')

@section('head')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('key')
<div id="cetak" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cetak-laporan-kartu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetak-laporan-kartu">Cetak Kartu</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cetak', [$idujian]) }}" method="get" target="_blank">
                <div class="modal-body">
                    @csrf
                    <input type="text" name="idujian" value="{{ $idujian }}" hidden id="">
                    <input type="text" name="kelas" value="{{ $kelas }}" hidden id="">
                    <div class='form-group'>
                        <label for='foridruangan' class='text-capitalize'>Ruangan</label>
                        <select name='idruangan' id='foridruangan' class='form-control'>
                            @foreach ($dataruangan as $dr)
                                <option value="{{ $dr->idruangan }}">{{ $dr->namaruangan }}</option>
                            @endforeach
                        <select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary px-3">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="cetakabsen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cetak-laporan-kartu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetak-laporan-kartu">Cetak Absen</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cetak.absen', [$idujian]) }}" method="get" target="_blank">
                <div class="modal-body">
                    <input type="text" name="idujian" value="{{ $idujian }}" hidden id="">
                    <input type="text" name="kelas" value="{{ $kelas }}" hidden id="">
                    <div class='form-group'>
                        <label for='foridruangan' class='text-capitalize'>Ruangan</label>
                        <select name='idruangan' id='foridruangan' class='form-control'>
                            @foreach ($dataruangan as $dr)
                                <option value="{{ $dr->idruangan }}">{{ $dr->namaruangan }}</option>
                            @endforeach
                        <select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary px-3">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="cetakdenah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cetak-laporan-kartu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetak-laporan-kartu">Cetak Denah Kelas</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cetak.denah', [$idujian]) }}" method="get" target="_blank">
                <div class="modal-body">
                    <input type="text" name="idujian" value="{{ $idujian }}" hidden id="">
                    <input type="text" name="kelas" value="{{ $kelas }}" hidden id="">
                    <div class='form-group'>
                        <label for='foridruangan' class='text-capitalize'>Ruangan</label>
                        <select name='idruangan' id='foridruangan' class='form-control'>
                            @foreach ($dataruangan as $dr)
                                <option value="{{ $dr->idruangan }}">{{ $dr->namaruangan }}</option>
                            @endforeach
                        <select>
                    </div>
                    <div class='form-group'>
                        <label for='forbaris' class='text-capitalize'>Jumlah Baris</label>
                        <select name='baris' id='forbaris' class='form-control'>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                            <option value='6'>6</option>
                        <select>
                    </div>
                    <div class='form-group'>
                        <label for='forpengawas' class='text-capitalize'>Jumlah Pengawas</label>
                        <select name='pengawas' id='forpengawas' class='form-control'>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                        <select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary px-3">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#cetak">
            <i class="fa fa-print"></i> Cetak Kartu
        </button>
        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#cetakabsen">
            <i class="fa fa-print"></i> Cetak Absensi
        </button>

        <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#cetakdenah">
            CETAK DENAH

        </button>


    </div>
    <div class="col-md-8">
        <form action="{{ route('cari', [$idujian]) }}" method="get">
        <div class="row">
                <div class="col-md-3">
                    <div class='form-group'>
                        <select name='jurusan' id='forjurusan' class='form-control' onchange="submit()">
                            <option value="">Semua jurusan</option>
                            @foreach ($datajurusan as $item)
                            <option value='{{ $item->idjurusan }}' @if ($jurusan == $item->idjurusan)
                                selected
                            @endif >{{ $item->jurusan }}</option>

                            @endforeach
                        <select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class='form-group'>
                        <select name='kelas' id='forkelas' class='form-control' onchange="submit()">
                            <option value="">Semua Kelas</option>
                            @foreach ($datakelas as $item)
                            <option value='{{ $item->idkelas }}' @if ($kelas == $item->idkelas)
                                selected
                            @endif >{{ $item->kelas }}</option>

                            @endforeach
                        <select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group my-0">
                        <input class="form-control" type="text" name="keyword" placeholder="keyword" aria-label="keyword" aria-describedby="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th width="5px">No</th>
                <th nowrap>Nama</th>
                <th nowrap>Rombel</th>
                <th nowrap>Kelola</th>
                <th>Lihat Gambar</th>
            </tr>

        </thead>

        <tbody>
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas->kelas }} {{ $item->jurusan->jurusan }}</td>

                    <td>
                        @php
                            $urutan = App\Models\urutanM::where("idujian", $idujian)->where("nisn", sprintf("%010s",$item->nisn))->first();
                            $nomorurut = empty($urutan->nomorurut)?"":$urutan->nomorurut;
                            $idruangan = empty($urutan->idruangan)?"":$urutan->idruangan;
                        @endphp
                        <form id="{{ $item->idsiswa }}">

                            <div class="d-inline">
                                <div class='form-group d-inline'>
                                    <input type='text' name='nomorurut' value="{{ $nomorurut }}" id='nomorurut{{ $item->idsiswa }}' class='p-1' placeholder='nomor urut'>
                                </div>
                                <div class='form-group d-inline'>
                                    <select name='idruangan' id='idruangan{{ $item->idsiswa }}' class='p-1'>
                                        <option value="">Pilih Ruangan</option>
                                        @foreach ($dataruangan as $ruang)
                                            <option value='{{ $ruang->idruangan }}' @if ($idruangan == $ruang->idruangan)
                                                selected
                                            @endif>{{ $ruang->namaruangan }}</option>

                                        @endforeach
                                    <select>
                                </div>

                                <button type="button" id="buttonprocess{{ $item->idsiswa }}" class="badge badge-btn border-0 @if (empty($urutan))
                                    badge-danger
                                @else
                                    badge-success
                                @endif " onclick="kirimpost{{ $item->idsiswa }}({{ $idujian }})">Proses</button>


                                <button @if (empty($urutan))
                                    hidden
                                @endif type="button" id="buttonhapus{{ $item->idsiswa }}" class="badge badge-btn badge-danger border-0" onclick="hapusurutan{{ $item->idsiswa }}({{ $idujian }})">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </div>
                        </form>
                    </td>
                    <td>
                        <a href="https://absen.smkn1gunungkijang.sch.id/gambar/siswa/{{empty($item->gambar->gambar)?'':$item->gambar->gambar}}" target="_blank" class="badge badge-info badge-btn py-1 border-0">Lihat Gambar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $siswa->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection



@section('foot')
<script>
    // Set CSRF token pada setiap permintaan Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@foreach ($siswa as $item)
<script>

    function kirimpost<?= $item->idsiswa ?>(idujian) {

        var formData = {
            nisn: "<?=$item->nisn;?>",
            nomorurut: document.getElementById("nomorurut<?=$item->idsiswa;?>").value,
            idruangan: document.getElementById("idruangan<?=$item->idsiswa;?>").value
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('kirim.urutan', ['idujian' => ':idujian']) }}"
                .replace(':idujian', idujian),
            data: formData,
            success: function(data) {
                if (data.success == "success") {
                    $('#buttonprocess<?=$item->idsiswa?>').removeClass('badge-danger').addClass('badge-success');
                    $('#buttonhapus<?=$item->idsiswa?>').removeAttr("hidden");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({icon: data.success, title: data.message});
                }else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({icon: data.success, title: data.message});
                }
            }
        });
    }

    function hapusurutan<?= $item->idsiswa ?>(idujian) {

    var formData = {
        nisn: "<?=$item->nisn;?>",
        nomorurut: document.getElementById("nomorurut<?=$item->idsiswa;?>").value,
        idruangan: document.getElementById("idruangan<?=$item->idsiswa;?>").value
    }

    $.ajax({
        type: 'DELETE',
        url: "{{ route('hapus.urutan', ['idujian' => ':idujian']) }}"
            .replace(':idujian', idujian),
        data: formData,
        success: function(data) {
            if (data.success == "success") {
                $('#buttonprocess<?=$item->idsiswa?>').removeClass('badge-success').addClass('badge-danger');
                $('#buttonhapus<?=$item->idsiswa?>').attr("hidden", true);
                document.getElementById("nomorurut<?=$item->idsiswa;?>").value="";
                document.getElementById("idruangan<?=$item->idsiswa;?>").value="";
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({icon: data.success, title: data.message});
            }else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({icon: data.success, title: data.message});
            }
        }
    });
    }

</script>

@endforeach
@endsection
