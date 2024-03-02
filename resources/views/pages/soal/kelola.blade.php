@extends('layouts.admin')

@section('judul', 'Soal Ujian')

@section('head', 'aasd')

@section('key')
<div id="tambahsoal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-soal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-soal">Tambah Soal</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('soal.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="number" name="idujian" value="{{ $idujian }}" hidden>
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <input id="mapel" required class="form-control" type="text" name="mapel" placeholder="masukan nama pelajaran">
                    </div>
    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-7">
                                <label for="tanggal">Tanggal</label>
                                <input id="tanggal" class="form-control" type="date" name="tanggal"></div>
                            <div class="col-5">
                                <label for="jam">JAM</label>
                                <input id="jam" class="form-control" type="time" name="jam"></div>
                        </div>
                        
                    </div>
    
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select
                            class="custom-select2 form-control"
                            name="jurusan[]"
                            multiple="multiple"
                            style="width: 100%; height: 38px"
                            required
                        >
                        <option value="SEMUA JURUSAN">SEMUA JURUSAN</option>
                        @foreach ($jurusan as $j)
                            @foreach ($kelas as $k)
                                <option value="{{ $k->kelas." ".$j->jurusan }}">{{ $k->kelas." ".$j->jurusan }}</option>
                            @endforeach
                        @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="links">Link Soal</label>
                        <input id="links" required class="form-control" type="text" name="links">
                    </div>
    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" required class="form-control" type="text" name="password">
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
        <div class="col-md-6">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahsoal">Tambah Soal</button>
        </div>
        <div class="col-md-6">
            <form action="{{ url()->current() }}">
                <div class="input-group my-0">
                    <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="keyword" aria-label="keyword" aria-describedby="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-secondary text-white" id="keyword">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5px">No</th>
                    <th>Mata Pelajaran</th>
                    <th>Rombel</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($soal as $item)
                    <tr>
                        <td>{{ $loop->iteration + $soal->firstItem() - 1 }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>
                            @php
                                $ex = explode(",", $item->jurusan);
                            @endphp
                            @foreach ($ex as $x)
                                <small class="badge badge-success badge-btn border-0">{{ $x }}</small>
                            @endforeach
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat("dddd, DD MMMM Y") }} jam {{ date("H:i", strtotime($item->tanggal)) }}
                        </td>
                        <td>
                            <button class="badge badge-btn border-0 badge-info d-inline" type="button" data-toggle="modal" data-target="#edit{{ $item->idsoal }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>

                            <form action='{{ route('soal.destroy', [$item->idsoal]) }}' method='post' class='d-inline'>
                                 @csrf
                                 @method('DELETE')
                                 <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='badge badge-danger badge-btn border-0'>
                                     <i class="fa fa-trash"></i>
                                 </button>
                            </form>
                        </td>
                    </tr>

                    <div id="edit{{ $item->idsoal }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-soal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambah-soal">Tambah Soal</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('soal.update', [$item->idsoal]) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="modal-body">
                                        <input type="number" name="idujian" value="{{ $idujian }}" hidden>

                                        <div class="form-group">
                                            <label for="mapel">Mata Pelajaran</label>
                                            <input id="mapel" required class="form-control" value="{{ $item->mapel }}" type="text" name="mapel" placeholder="masukan nama pelajaran">
                                        </div>
                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-7">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input id="tanggal" class="form-control" value="{{ date('Y-m-d', strtotime($item->tanggal)) }}" type="date" name="tanggal"></div>
                                                <div class="col-5">
                                                    <label for="jam">JAM</label>
                                                    <input id="jam" class="form-control" type="time" value="{{ date('H:i', strtotime($item->tanggal)) }}" name="jam"></div>
                                            </div>
                                            
                                        </div>
                        
                                        <div class="form-group">
                                            @php
                                                $ex = explode(",", $item->jurusan);
                                                
                                            @endphp
                                            <label>Jurusan</label>
                                            <select
                                                class="custom-select2 form-control"
                                                name="jurusan[]"
                                                multiple="multiple"
                                                style="width: 100%; height: 38px"
                                                required
                                            >
                                            <option value="SEMUA JURUSAN">SEMUA JURUSAN</option>
                                            @foreach ($jurusan as $j)
                                                @foreach ($kelas as $k)
                                                @foreach ($ex as $x)
                                                <option value="{{ $k->kelas." ".$j->jurusan }}" @if ($x == $k->kelas." ".$j->jurusan)
                                                    selected
                                                @endif>{{ $k->kelas." ".$j->jurusan }}</option>
                                                    
                                                @endforeach
                                                        
                                                @endforeach
                                            @endforeach
                                            </select>
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="links">Link Soal</label>
                                            <input id="links" required value="{{ $item->links }}" class="form-control" type="text" name="links">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" required value="{{ $item->password }}" class="form-control" type="text" name="password">
                                        </div>
                        
                        
                                        
                        
                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        {{ $soal->links("vendor.pagination.bootstrap-4") }}
    </div>
@endsection


@section('foot')
    
<script>
    $('.custom-select2').select2({
        theme: 'bootstrap4',
        dropdownParent: $('#tambahsoal')
    });

</script>
@endsection