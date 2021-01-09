{{-- Ini Halaman Print --}}
<style>
    h1,h2,h3,h4,h5,h6 {
        margin:0;
    }
    table {
        border-spacing: 0;
    }
    .kegiatan {
        min-width: 350px;
    }
    .text-center {
        text-align: center;
    }
    .bg-grey {
        background: lightgrey;
    }
    .clearboth {
        clear: both;
    }
    .logo {
        margin-left: 2cm;
        width: 3cm;
        height: 3cm;
        float: left;
    }
    
    .kop {
        width: 15cm;
        height: 3cm;
        float: left;
    }
    
    .img-fluid {
        width: 100%
    }
    
    body {
        max-width: 21cm;
    }

    .text-bold {
        font-weight: bold;
    }

</style>
<div>
    <div class="logo">
        <img class="img-fluid" src="{{ url('/vendor/iain/logo.png') }}">
    </div>
    <div class="kop text-center">
        <h2>KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
        <h4>INSTITUT AGAMA ISLAM NEGERI TERNATE</h4>
        <p>Jalan Lumba-lumba Kelurahan Dufa-dufa Ternate 97727<br/>Telepon: (0921) 3121426 Faximile: (0921) 3123773<br/>Website: www.iain-ternate.ac.id</p>
    </div>
    <div class="clearboth"></div>
</div>
<hr/>
<br/>
<br/>
<h2 class="text-center">FORMULIR RENCANA BEBAN KERJA DOSEN</h2>
<br/>
<br/>
<table>
    <tr>
        <th>Nama</th>
        <td>Dr. Gunawan M.Pd., M.Ed.</td>
    </tr>
    <tr>
        <th>No. Sertifikat</th>
        <td>1930187635</td>
    </tr>
    <tr>
        <th>Perguruan Tinggi</th>
        <td>IAIN TERNATE</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>DOSEN TETAP</td>
    </tr>
    <tr>
        <th>Alamat PT</th>
        <td>Jalan Lumba-lumba Kelurahan Dufa-dufa Ternate 97727</td>
    </tr>
    <tr>
        <th>Jurusan</th>
        <td>TABIYAH GURU</td>
    </tr>
    <tr>
        <th>Program Studi</th>
        <td>Pendidikan Agama Islam</td>
    </tr>
    <tr>
        <th>Jab. Fungsional / Gol</th>
        <td>LEKTOR KEPALA / IV D</td>
    </tr>
    <tr>
        <th>Tempat/Tanggal Lahir</th>
        <td>Jakarta / 10 Desember 1950</td>
    </tr>
    <tr>
        <th>Ilmu Yang Ditekuni</th>
        <td>TABIYAH & ILMU KEGURUAN</td>
    </tr>   
    <tr>
        <th>No. HP</th>
        <td>081234567890</td>
    </tr>    
</table>
<br/><br/>
<table border=1 style="width: 21cm;">
    <thead>
        <tr>
            <th rowspan=2>NO</th>
            <th rowspan=2>Kegiatan</th>
            <th colspan=2>Beban Kerja</th>
        </tr>
        <tr>
            <th>Bukti Penugasan</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($kategori as $k)
        <tr>
            <th colspan=4>{{ $k->Bidang }}</th>
        </tr>
        @for ($i = 0; $i < count($detail); $i++)
            @if ($detail[$i]->Bidang == $k->Bidang)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $detail[$i]->Jenis_Kegiatan }}</td>
                    <td>{{ $detail[$i]->Bukti_Penugasan }}</td>
                    <td>{{ $detail[$i]->SKS_RBKD }}</td>
                </tr>
            @endif
        @endfor
    @endforeach
    </tbody>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<table style="min-width: 21cm;" class="text-center">
    <tr>
        <td style="width: 50%">
            <br/>
            <br/>
            Ternate, {{ $header->tanggal_pengesahan->format("d-m-Y") }}<br/>
            Dosen Yang Membuat,<br/>
            <img src='{{ url("skp/".$id."/print/qr") }}'>
            <br/>
            {{ $header->Atasan->nama }}
        </td>
        <td style="width: 50%">
            Ketua Jurusan/Prodi/Manajemen,
            <div style="height: 185px"></div>
            Dr. Gunawan M.Pd., M.Ed.
        </td>
    </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<script>window.print()</script>
