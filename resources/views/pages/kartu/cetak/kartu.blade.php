@php
    $w = 332.03937008 * 3.125;
    $h = 210.06448819 * 3.125;
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
    <title>Document</title>
    <style>
        @page {
            margin-left: 65px;
            margin-top: 200px;
        }
        body   {

        }
        .kartu {

            border: 1px solid rgb(204, 204, 204);
            width: <?php echo $w;?>px;
            height: <?php echo $h;?>px;
            margin: 10px;
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
        <table width="100%" align="center" style="border-bottom: 3px double darkgray;padding:4px 0">
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

        <table width="100%" style="margin: 15px auto;margin-top:25px">
            <tr>
                <td class="p2">
                    <center>
                        <b>KARTU PESERTA {{ $item->ujian->namaujian }}</b>
                    </center>
                </td>
            </tr>
            <tr>
                <td class="p3">
                    <center>
                        TAHUN PELAJARAN {{ $item->ujian->tahunawal }} / {{ $item->ujian->tahunakhir }}
                    </center>
                </td>
            </tr>
        </table>

        <table width="100%">
            <td width="25%" align="right" valign="justify">
                @if (empty($item->siswa->gambar->gambar))

                <img src="{{ url('gambar', ["noimage.PNG"]) }}" style="max-height: 220px" alt="">

                @else
                <img src="https://absen.smkn1gunungkijang.sch.id/gambar/siswa/{{ str_replace(" ", "%20", $item->siswa->gambar->gambar) }}" style="max-height: 220px" alt="">

                @endif
            </td>
            <td valign="top" style="padding: auto 25px;font-size: 8pt" >
                <table>
                    <tr class="lh">
                        <td valign="top">NAMA </td>
                        <td valign="top" width="30px">:</td>
                        <td nowrap valign="top">
                            <b>
                                 {{ strtoupper($item->siswa->nama) }}
                            </b>
                        </td>
                    </tr>
                    <tr class="lh">
                        <td valign="top">ROMBEL </td>
                        <td valign="top">:</td>
                        <td nowrap valign="top">
                            <b>
                                 {{ $item->siswa->kelas->kelas." ".$item->siswa->jurusan->jurusan  }}
                            </b>
                        </td>
                    </tr>
                    <tr class="lh">
                        <td valign="top" nowrap>NO URUT </td>
                        <td valign="top">:</td>
                        <td nowrap valign="top">
                            <b class="p3">
                                {{ $item->nomorurut }}
                            </b>
                        </td>
                    </tr>
                </table>
            </td>
        </table>

    </div>

    @endforeach



    </div>







</body>
</html>

