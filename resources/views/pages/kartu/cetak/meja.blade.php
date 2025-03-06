@php
    $w = 332.03937008 * 3.325;
    $h = 210.06448819 * 3.265;
    // $photo = 56.590551181 * 3.125;
    $photo = 47.590551181 * 3.125;
    $p = 1 * 3.125;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Ujian</title>
    <style>
        @page {
            margin-left: 20px;
            margin-top: 200px;
        }
        body   {

        }
        .kartu {
            page-break-inside: avoid;
            border: 5px double rgb(128, 128, 128);
            width: <?php echo $w;?>px;
            height: <?php echo $h;?>px;
            margin: 5px;
            margin-bottom:25px;
            display: inline-block;
            border-radius: 20px;
        }

        .lh {
            line-height: 60px;
        }

        .photo {
            border:5px solid white;
        }
        .identitas {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: justify;
        }
        h3 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .cetak {
            margin: 0;
            padding: 0;
            display: inline-block;
        }
        .p1 {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
        }
        .p2 {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.3pt;
        }
        .p3 {
            margin: 0;
            padding: 0;
            font-family: serif;
            font-size: 9.5pt;
        }
        .p4 {
            margin: 0;
            padding: 0;
            font-family: serif;
            font-size: 9pt;
        }
        .p {
            margin: 0;
            padding: 0;
        }

        /* @media print{
            @page {size: landscape}
            @page { margin: 0px; }
        body { margin: 0px; }
        } */

    </style>
</head>
<body>

    <div class="cetak">


    @foreach ($data as $item)
    <div class="kartu" style="page-break-before: always;">
        <table width="100%" align="center" style="border-bottom: 8px double rgb(128, 127, 127);padding:4px 0">
            <tr>
                <td class="p2">
                    <center>
                        PEMERINTAH PROVINSI KEPULAUAN RIAU

                    </center>
                </td>
            </tr>
            <tr>
                <td class="p3">
                    <center>
                        DINAS PENDIDIKAN

                    </center>
                </td>
            </tr>
            <tr>
                <td class="p1">
                    <center>
                        <b>SMKN 1 GUNUNG KIJANG</b>

                    </center>
                </td>
            </tr>
            <tr>
                <td class="p4">
                    <center>
                        Jl. Poros Pulau Pucung-Lome Desa Malang Rapat

                    </center>
                </td>
            </tr>
        </table>


        <table width="100%">
            <tr>
                <td valign="justify" align="center" style="padding: auto 25px;font-size: 8pt" >
                    <table width="100%">
                        <tr>
                            <td>
                                <center>
                                    <br><br><br>
                                    <h1 style="margin: 0;padding: 0">{{ $item->nomorurut }}</h1>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>

                                    <h2 style="margin: 0;padding: 0">{{ strtoupper($item->siswa->nama) }}</h2>
                                    <br><br>
                                </center>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
        </table>


        <table width="100%" style="margin: 15px auto;margin-top:5px;border-top: 8px double rgb(121, 121, 121);padding:4px 0">
                <td class="p3" style="padding-top:15px ">
                    <center>
                        TAHUN PELAJARAN {{ $item->ujian->tahunawal }} / {{ $item->ujian->tahunakhir }}
                    </center>
                </td>
            </tr>
        </table>


    </div>

    @endforeach



    </div>







</body>
</html>

