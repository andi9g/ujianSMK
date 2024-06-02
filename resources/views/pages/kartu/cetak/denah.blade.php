
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
            margin-top: 100px;
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
    </style>
</head>
<body>

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
                <img src="https://absen.smkn1gunungkijang.sch.id/gambar/siswa/{{ str_replace(" ", "%20", $item->siswa->gambar->gambar) }}" width="30%" alt="">
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

