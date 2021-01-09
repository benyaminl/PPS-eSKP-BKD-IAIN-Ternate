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
<h2 class="text-center">FORMULIR SASARAN KERJA</h2>
<h4 class="text-center">PEGAWAI NEGERI SIPIL</h4>
<br/>
<br/>
<table border=1 style="width: 21cm;">
    <tr class="text-bold">
        <td>No</td>
        <td colspan=4>I. PEJABAT PENILAI</td>
        <td>No</td>
        <td colspan=8>II. PEGAWAI NEGERI SIPIL YANG DINILAI</td>
    </tr>
    <tr>
        <td>1</td>
        <td colspan=2>Nama</td>
        <td colspan=2>{{ $header->Atasan->nama }}</td>
        {{-- Pejabat Penilai --}}
        <td>1</td>
        <td colspan=4>Nama</td>
        <td colspan=4>{{ $header->Pegawai->nama }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td colspan=2>NIP</td>
        <td colspan=2>{{ $header->Atasan->nip }}</td>
        {{-- Pejabat Penilai --}}
        <td>2</td>
        <td colspan=4>NIP</td>
        <td colspan=4>{{ $header->Pegawai->nip }}</td>
    </tr>
    <tr>
        <td>3</td>
        <td colspan=2>Pangkat/Gol.Ruang</td>
        <td colspan=2>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan }}</td>
        {{-- Pejabat Penilai --}}
        <td>3</td>
        <td colspan=4>Pangkat/Gol.Ruang</td>
        <td colspan=4>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan }}</td>
    </tr>
    <tr>
        <td>4</td>
        <td colspan=2>Jabatan</td>
        <td colspan=2>{{ $header->Atasan->jabatan }}</td>
        {{-- Pejabat Penilai --}}
        <td>4</td>
        <td colspan=4>Jabatan</td>
        <td colspan=4>{{ $header->Pegawai->jabatan }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td colspan=2>Unit Kerja</td>
        <td colspan=2>{{ $header->Atasan->biro }}</td>
        {{-- Pejabat Penilai --}}
        <td>5</td>
        <td colspan=4>Unit Kerja</td>
        <td colspan=4>{{ $header->Pegawai->biro }}</td>
    </tr>
    {{-- BODY dari Tugas Jabatan --}}
    {{-- Header Nya --}}
    <tr class="text-bold text-center">
        <td rowspan=2>NO</td>
        <td rowspan=2 colspan=2>III. KEGIATAN TUGAS JABATAN</td>
        <td class="text-cente" colspan=5>TARGET</td>
        <td class="text-cente" colspan=5>REALISASI</td>
    </tr>
    <tr class="text-bold">
        <td>Angka<br/>Kredit</td>
        <td>KUANT<br/>/OUTPUT</td>
        <td>KUAL<br/>/MUTU</td>
        <td>WAKTU</td>
        <td>BIAYA</td>
        <td>Angka<br/>Kredit</td>
        <td>KUANT<br/>/OUTPUT</td>
        <td>KUAL<br/>/MUTU</td>
        <td>WAKTU</td>
        <td>BIAYA</td>
    </tr>
    {{--
    <tr class="text-center bg-grey">
        <td>1</td>
        <td colspan=2>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
    </tr>
    --}}
    {{-- Body --}}
    @for($i=0; $i< count($detail); $i++) 
    <tr class="text-center">
        <td>{{ $i+1 }}</td>
        <td colspan=2>{{ $detail[$i]->tugas_jabatan }}</td>
        <td>{{ ($detail[$i]->angka_kredit > 0) ? $detail[$i]->angka_kredit : "-" }}</td>
        <td>{{ $detail[$i]->kuant_output }}</td>
        <td>{{ $detail[$i]->kual_mutu }}</td>
        <td>{{ $detail[$i]->waktu }}</td>
        <td>{{ ($detail[$i]->biaya == 0) ? $detail[$i]->biaya : "-" }}</td>
        <td>{{ ($detail[$i]->Penilaian->angka_kredit > 0) ? $detail[$i]->Penilaian->angka_kredit : "-" }}</td>
        <td>{{ $detail[$i]->Penilaian->kuant_output }}</td>
        <td>{{ $detail[$i]->Penilaian->kual_mutu }}</td>
        <td>{{ $detail[$i]->Penilaian->waktu }}</td>
        <td>{{ ($detail[$i]->Penilaian->biaya == 0) ? $detail[$i]->Penilaian->biaya : "-" }}</td>
    </tr>
    @endfor
    {{-- End Body --}} 
</table>
<br/>
<br/>
<br/>
<h4>Tugas Tambahan</h4><br/>
<table style="width: 21cm" border="1">
    <tr>
        <th>NO</th>
        <th>Tugas Tambahan</th>
        <th>Nomor SK</th>
        <th>Nilai</th>
    </tr>
    <tr>
        <td></td><td></td><td></td>
        <td rowspan="{{ count($tugasTambahan)+1 }}">{{ $header->getNilaiTugasTambahan() }}</td>
    </tr>
    @foreach ($tugasTambahan as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->tugas_tambahan }}</td>
        <td>{{ $d->nomor_sk }}</td>
    </tr>
    @endforeach
</table>
<br/>
<br/>
<br/>
<table style="min-width: 21cm;" class="text-center">
    <tr>
        <td style="width: 50%">
            <br/>
            <br/>
            Pejabat Penilai,<br/>
            <img src='{{ url("skp/".$id."/print/qr") }}'>
            <br/>
            {{ $header->Atasan->nama }}
        </td>
        <td style="width: 50%">
            Ternate, {{ $header->tanggal_pengesahan->format("d-m-Y") }}<br/>
            Pegawai Negeri Sipil Yang Dinilai,
            <div style="height: 185px"></div>
            {{ $header->Pegawai->nama }}
        </td>
    </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<script>window.print()</script>
