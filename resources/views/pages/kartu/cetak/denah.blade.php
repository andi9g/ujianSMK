@php
    $romawi = ["NONE","I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI"];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Denah</title>
    <style>
        @page {
            margin-left: 65px;
            margin-top: 50px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1, h2, h3, h4, h5, p {
            padding: 0;
            margin: 0;
        }
        table {
            font-size: 10pt;
            border-collapse: collapse;
            width: 100%;
        }
        td {
            padding: 15px;
        }
        th {
            padding: 15px;
        }
        .p2 {
            padding: 10pt 0;
        }
        .mb2 {
            margin-bottom: 10pt;
        }
        .kotak {
            padding: 15px 0;
            width: 100%;
            text-align: center;
            border: 1px solid black;
            max-width: 800px;
            background: rgb(190, 190, 190);
            display: inline-block;
        }
        .kotakpengawas {
            padding: 15px 0;
            width: 100%;
            text-align: center;
            border: 1px solid black;
            background: rgb(190, 255, 190);
            max-width: 500px;
            display: inline-block;
        }
        .kotaksiswa {
            padding: 15px 0;
            width: 90%;
            text-align: center;
            border: 1px solid black;
            display: inline-block;
            font-size: 9pt;
            height: 400px;
        }
        td.centered {
            text-align: center;
        }
        .myFont {
            font-size: 11pt;
        }

        h3, h2, h1, .pm-0{
            margin: 0;
            padding: 0;
        }

        .pk {
            font-size: 8pt;
        }
    </style>
</head>
<body>

    {{-- <table width="100%" style="border-bottom: 10px double rgb(41, 41, 41);padding:4px 0">
        <tr>
            <td width="15%">
                <center>
                    <img src="{{ url('gambar/logo/kepri.png', []) }}" height="350px" alt="">
                </center>
            </td>
            <td>
                <table width="100%" align="center" >
                    <tr>
                        <td class="pm-0">
                            <center>
                                <h3>
                                    PEMERINTAH PROVINSI KEPULAUAN RIAU
                                </h3>

                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td class="pm-0">
                            <center>
                                <h3>
                                    DINAS PENDIDIKAN

                                </h3>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td class="pm-0">
                            <center>
                                <h2>
                                    <b>SMKN 1 GUNUNG KIJANG</b>
                                </h2>

                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td class="pm-0">
                            <center>
                                <small class="pk">Jl. Poros Pulau Pucung – Lome, Km 48 Desa Malang Rapat Kecamatan Gunung Kijang Kode Pos 29153</small>
                                <small class="pk">Webside:www.smkn1gunungkijang.sch.id &nbsp;|&nbsp; Email : smkn1gukibintan@gmail.com</small>

                            </center>
                        </td>
                    </tr>
                </table>

            </td>
            <td width="15%">
                <center>
                    <img src="{{ url('gambar/logo/smk.png', []) }}" height="350px" alt="">
                </center>
            </td>
        </tr>
    </table> --}}



<table width="100%" style="margin-top: 30px;">
    <tr>
        <td class="centered" style="padding-bottom: 30px">
            <h3>RUANGAN {{ $ruangan->namaruangan }}</h3>
            {{-- <h3>{{ $ujian->namaujian }} </h3> --}}
        </td>
    </tr>

</table>

<table width="100%" >
    <tr>
        <td width="30%"></td>
        <td class="centered">
            <div class="kotak">
                PAPAN TULIS
            </div>
        </td>
        <td width="30%"></td>
    </tr>

</table>

<table width="100%" >
    <tr>
        @for ($i=1;$i<=$pengawas;$i++)
        <td class="centered">
            <div class="kotakpengawas">
                PENGAWAS {{ sprintf("%02s", $i) }}
            </div>
        </td>

        @endfor
    </tr>
</table>

<br>

<table width="100%">
    @php
        $columns = 0;
    @endphp
    @foreach ($data as $item)
        @if ($columns % $baris == 0)
            <tr>
        @endif

        <td class="centered" width="{{ 100 / $baris }}%">
            <div class="kotaksiswa">
                <p class="myFont">{{ sprintf("%02s", $loop->iteration) }}</p>
                @if (empty($item->siswa->gambar->gambar))
                <img src="{{ url('gambar', ["noimage.PNG"]) }}" style="max-height: 220px" alt="">
                @else
                <img src="https://absen.smkn1gunungkijang.sch.id/gambar/siswa/{{ str_replace(" ", "%20", $item->siswa->gambar->gambar) }}" width="30%" alt="">
                @endif
                <br>
                <b>
                    {{ strtoupper($item->siswa->nama) }}
                    <br>
                    {{ $item->nomorurut }}
               </b>

            </div>
        </td>

        @php
            $columns++;
        @endphp

        @if ($columns % $baris == 0)
            </tr>
        @endif
    @endforeach
    @if ($columns % $baris != 0)
        </tr>
    @endif

</table>









</body>
</html>

