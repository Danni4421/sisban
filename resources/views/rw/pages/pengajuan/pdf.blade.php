<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengajuan Bansos</title>

    <style>
        /* CSS untuk desain kop surat */
        .kop-surat {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        /* CSS untuk garis pemisah */
        .garis-pemisah {
            border-top: 2px solid black;
            margin-bottom: 20px;
        }

        /* CSS untuk bagian kanan surat */
        .bagian-kanan {
            float: right;
        }

        /* CSS untuk lampiran */
        .lampiran {
            margin-top: 135px;
        }

        /* CSS untuk paragraf */
        p {
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Desain kop surat -->
        <div class="kop-surat">
            <h3><center>RUKUN WARGA RW.07
                <br>DUSUN KETANGI DESA TEGALGONDO<br>KECAMATAN KARANGPLOSO KABUPATEN MALANG</p>
            </h3>
        </div>
        <!-- Garis pemisah -->
        <div class="garis-pemisah"></div>

        <!-- Bagian tanggal surat -->
        <?php
            use Carbon\Carbon;

            $tempat = "Malang";

            $romawi = [
                'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
            ];
        ?>
        <p>{{ $tempat }}, {{ Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</p>

        <!-- Bagian kiri surat -->
        <table class="table">
            <tr>
                <td>Nomor</td>
                <td> : </td>
                <td>{{$pengajuan->nomor_surat}}/SP/{{$romawi[$pengajuan->updated_at->month]}}/{{$pengajuan->updated_at->year}}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td> : </td>
                <td>1 (satu) bendel</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td> : </td>
                <td>Permohonan Bantuan Sosial</td>
            </tr>
        </table>
        <!-- Bagian kanan surat -->
        <div class="bagian-kanan">
            <p>Kepada Yth,</p>
            <p>Petugas Penyalur Bantuan Sosial</p>
            <p>di Tempat</p>
        </div>
        <div style="clear:both;"></div>
        <!-- Isi surat -->
        <p>Dengan Hormat,</p>
        <p>Bersama ini kami sampaikan surat permohonan bantuan sosial untuk warga Dusun Ketangi Desa Tegalgondo Kecamatan Karangploso Kabupaten Malang. Berikut nama warga yang diharapkan bisa menerima bantuan tersebut:</p>
        <table class="table">
            <tr>
                <td>No KK</td>
                <td> : </td>
                <td>{{ $pengajuan->no_kk }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td> : </td>
                <td>{{ $pengajuan->keluarga->kepala_keluarga->nik }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td>{{ $pengajuan->keluarga->kepala_keluarga->nama }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td> : </td>
                <td>{{ $pengajuan->keluarga->kepala_keluarga->tempat_tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Nomor Telp.</td>
                <td> : </td>
                <td>{{ $pengajuan->keluarga->kepala_keluarga->no_hp }}</td>
            </tr>
            <tr>
                <td>RT</td>
                <td> : </td>
                <td>{{ $pengajuan->keluarga->rt }}</td>
            </tr>
        </table>
        <p>Warga tersebut betul-betul warga Dusun Ketangi Desa Tegalgondo Kecamatan Karangploso Kabupaten Malang yang membutuhkan bantuan sosial, besar harapan kami semoga berkenan dan dapat terkabul permohonan ini.</p>
        <p>Demikian surat permohonan ini kami buat, atas bantuan dan terkabulnya permohonan tersebut kami ucapkan terimakasih.</p>
        {{-- Tanda tangan --}}
        <div class="bagian-kanan">
            <p>Kepala Dusun Ketangi</p>
            <br><br>
            <strong><u>{{ $rw->nama }}</u></strong>
        </div>

        <!-- Lampiran -->
        <div class="lampiran">
            <p>Lampiran:
                <br>1. Foto Kartu Keluarga
                <br>2. Foto Kartu Tanda Penduduk
            </p>
        </div>
    </div>

    <div class="foto-lampiran">
        <!-- Foto KK -->
        @if (!is_null($pengajuan->keluarga->foto_kk))
            <img src="{{ asset($pengajuan->keluarga->foto_kk) }}" alt="Foto KK" style="object-position: center; width: 90%">
        @endif
        <!-- Foto KTP -->
        @if (!is_null($pengajuan->keluarga->foto_ktp))
            <img src="{{ asset($pengajuan->keluarga->foto_ktp) }}" alt="Foto KTP" style="object-position: center; width: 90%">
        @endif
    </div>

</body>
</html>