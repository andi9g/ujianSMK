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
                <img src="{{ url('gambar/logo', ['kepri.png']) }}" height="300px" alt="">
            </td>
            <td width="100%" style="text-align: center">
                <h4>PEMERINTAH PROVINSI KEPULAUAN RIAU</h4>
                <h3 >DINAS PENDIDIKAN</h3  >
                    <h3>SMK NEGERI 1 GUNUNG KIJANG</h3>
                    <p style="font-size: 9pt">Jl. Poros Pulau Pucung – Lome, Km 48 Desa Malang Rapat Kecamatan Gunung Kijang Kode Pos 29153
                        </p>
                        <p style="font-size: 9pt">NSS : 401310102006 NPSN : 11003305 </p>
                        <p style="font-size: 9pt">Webside : www.smkn1gunungkijang.sch.id  Email : smkn1gukibintan@gmail.com </p>
            </td>
            <td width="190px">
                <img src="{{ url('gambar/logo', ['smk.png']) }}" height="300px" alt="">
            </td>
        </tr>
    </table>

    <div class="p2" style="text-align: center">
        <p>DAFTAR HADIR PESERTA {{ $data->first()->ujian->namaujian }}</p>
        <p>TP. {{ $data->first()->ujian->tahunawal }} / {{ $data->first()->ujian->tahunakhir }}</p>

    </div>
    <div class="mb2">
        RUANGAN {{ sprintf("%02s", $data->first()->ruangan->namaruangan) }}
        <table>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Tanggal &nbsp;&nbsp;</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
    </div>

    <table width="100%" border="1">
        @php
            $strlen = strlen($data->first()->nomorurut);
        @endphp
        <tr>
            <th width="5px">No</th>
            <th >Nama</th>
            <th width="10px">L/P</th>
            <th colspan="{{ $strlen }}">Nomor Peserta</th>
            <th  colspan="2">TTD</th>
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
                <td valign="top" style="border:none;font-size: 10pt">
                    @if ($loop->iteration % 2 == 1)
                        {{ $loop->iteration }} . . . . .
                    @endif
                </td>
                <td valign="top" style="border:none;font-size: 10pt"">
                    @if ($loop->iteration % 2 == 0)
                    {{ $loop->iteration }} . . . . .
                @endif
                </td>
            </tr>

        @endforeach

    </table>

    <br>
    <table width="100%">
        <tr>
            @for ($i=1; $i <= $pengawas; $i++)
                @if ($pengawas == 1)
                    <td width="100%" align="left">

                    </td>

                @else
                    <td width="{{ 100/$pengawas }}%" align="center">
                        Pengawas {{ $i }}
                        <br><br><br><br>
                        _________________________
                    </td>

                @endif



            @endfor
        </tr>
    </table>

</body>
</html>
