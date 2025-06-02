<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Absen {{ $idruangan }} </title>
    <style>
        @page {
            margin-top: 10pt;
        }
        h1{
            padding: 0;
            margin: 0;
        }
        h2{
            padding: 0;
            margin: 0;
        }
        h3{
            padding: 0;
            margin: 0;
        }
        h4{
            padding: 0;
            margin: 0;
        }
        h5{
            padding: 0;
            margin: 0;
        }
        p{
            padding: 0;
            margin: 0;
        }
        table {
            font-size: 10pt;
            border-collapse: collapse;

        }
        tr td {
            padding: 15px;
        }
        tr th {
            padding: 15px;
        }
        .p2  {
            padding: 10pt 0;
        }
        .mb2  {
            margin-bottom: 10pt;
        }

    </style>
</head>
<body>
    <table width="100%" style="border-bottom:2px double black" >
        <tr>
            <td width="190px">
                <img src="{{ url('gambar/logo', ['kepri.png']) }}" height="250px" alt="">
            </td>
            <td width="100%" style="text-align: center">
                <h4>PEMERINTAH PROVINSI KEPULAUAN RIAU</h4>
                <h3 >DINAS PENDIDIKAN</h3  >
                    <h3>SMK NEGERI 1 GUNUNG KIJANG</h3>
                    <p style="font-size: 9pt">Jl. Poros Pulau Pucung – Lome, Km 48 Desa Malang Rapat Kecamatan Gunung Kijang Kode Pos 29153
                        </p>
                        {{-- <p style="font-size: 9pt">NSS : 401310102006 NPSN : 11003305 </p> --}}
                        <p style="font-size: 9pt">Webside : www.smkn1gunungkijang.sch.id  Email : smkn1gukibintan@gmail.com </p>
            </td>
            <td width="190px">
                <img src="{{ url('gambar/logo', ['smk.png']) }}" height="250px" alt="">
            </td>
        </tr>
    </table>

    <div class="p2" style="text-align: center;font-size: 11pt">
        <p>DAFTAR PESERTA {{ $data->first()->ujian->namaujian }}</p>
        <p>TP. {{ $data->first()->ujian->tahunawal }} / {{ $data->first()->ujian->tahunakhir }}</p>

    </div>
    <div class="mb2" style="font-size: 11pt">
        RUANGAN {{ sprintf("%02s", $data->first()->ruangan->namaruangan) }}

    </div>

    <table width="100%" border="1" style="font-size: 9pt">
        @php
            $strlen = strlen($data->first()->nomorurut);
        @endphp
        <tr>
            <th width="5px">No</th>
            <th >Nama</th>
            <th width="10px">L/P</th>
            <th colspan="{{ $strlen }}">Nomor Peserta</th>

        </tr>


        @foreach ($data as $item)
            <tr>
                <td><center>
                    {{ $loop->iteration }}
                    </center>
                </td>
                <td>{{ ucwords(strtolower($item->siswa->nama)) }}</td>
                <td>
                    <center>
                        {{ strtoupper($item->siswa->jk) }}
                    </center>
                </td>
                @php
                    $split = str_split($item->nomorurut);
                @endphp
                @foreach ($split as $s)
                <td style="text-align: center; @if ($s == '-')
                    background: lightgray;
                @else
                    font-weight:bold;
                @endif" >{{ $s }}</td>

                @endforeach
            </tr>

        @endforeach

    </table>

    <br>
    <table width="100%">
        <tr>
            <td align="" width="50%"></td>
            <td align="center" width="50%">Gunung Kijang, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::parse(($tanggal))->isoFormat("MMMM Y") }}</td>
        </tr>
    </table>
    <table width="100%">
        <tr valign="top">
            <td align="center" width="50%">
                <p>Mengetahui</p>
                <p>Kepala SMKN 1 Gunung Kijang</p>
                    <br><br><br><br>
                <p >
                    <u>
                        <font style="text-transform: uppercase">Mustafa Kamal</font>, M.Pd
                    </u>
                </p>
                <p>NIP. 19800909 201001 1 018</p>
                <img src="{{ url('gambar/ttd_pak_kamal.png', []) }}" height="250px" style="margin-top:-280px" alt="">
            </td>
            <td align="center" width="50%">
                <br>
                <p>Ketua Pelaksana</p>
                <br><br><br><br>
                <p>
                    <u>
                        <font style="text-transform: uppercase">Suly Andriansyah</font>, S.Pd.I
                    </u>
                </p>
                <p>NIPPPK. 19910807 202321 1 008</p>
                <img src="{{ url('gambar/ttd_suly.png', []) }}" height="150px" style="margin-top:-260px" alt="">
            </td>
        </tr>
    </table>


</body>
</html>
