{{-- Ini Halaman Print --}}
<style>
.kegiatan {
    min-width: 350px;
}
.text-center {
    text-align: center;
}
.bg-grey {
    background: lightgrey;
}
</style>
<table border=1 style="width: 21cm;">
    <tr>
        <td>No</td>
        <td colspan=2>I. PEJABAT PENILAI</td>
        <td>No</td>
        <td colspan=4>II. PEGAWAI PNS YANG DINILAI</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Nama</td>
        <td>{{ $header->Atasan->nama }}</td>
        {{-- Pejabat Penilai --}}
        <td>1</td>
        <td colspan=2>Nama</td>
        <td colspan=2>{{ $header->Pegawai->nama }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td>NIP</td>
        <td>{{ $header->Atasan->nip }}</td>
        {{-- Pejabat Penilai --}}
        <td>2</td>
        <td colspan=2>NIP</td>
        <td colspan=2>{{ $header->Pegawai->nip }}</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Pangkat/Gol.Ruang</td>
        <td>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan }}</td>
        {{-- Pejabat Penilai --}}
        <td>3</td>
        <td colspan=2>Pangkat/Gol.Ruang</td>
        <td colspan=2>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan }}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Jabatan</td>
        <td>{{ $header->Atasan->jabatan }}</td>
        {{-- Pejabat Penilai --}}
        <td>4</td>
        <td colspan=2>Jabatan</td>
        <td colspan=2>{{ $header->Pegawai->jabatan }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Unit Kerja</td>
        <td>{{ $header->Atasan->biro }}</td>
        {{-- Pejabat Penilai --}}
        <td>5</td>
        <td colspan=2>Unit Kerja</td>
        <td colspan=2>{{ $header->Pegawai->biro }}</td>
    </tr>
    {{-- BODY dari Tugas Jabatan --}}
    {{-- Header Nya --}}
    <tr class="text-center">
        <td rowspan=2>NO</td>
        <td rowspan=2 colspan=2>III. KEGIATAN TUGAS JABATAN</td>
        <td rowspan=2>Angka<br/>Kredit</td>
        <td class="text-cente" colspan=4>TARGET</td>
    </tr>
    <tr>
        <td>KUANT/OUTPUT</td>
        <td>KUAL/MUTU</td>
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
    <tr>
        <td>{{ $i+1 }}</td>
        <td colspan=2>{{ $detail[$i]->tugas_jabatan }}</td>
        <td>{{ $detail[$i]->angka_kredit }}</td>
        <td>{{ $detail[$i]->kuant_output }}</td>
        <td>{{ $detail[$i]->kual_mutu }}</td>
        <td>{{ $detail[$i]->waktu }}</td>
        <td>{{ $detail[$i]->biaya }}</td>
    </tr>
    @endfor
    {{-- End Body --}} 
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
            Pejabat Penilai,
            <br/>
            <br/>
            <br/>
            <br/>
            {{ $header->Atasan->nama }}
        </td>
        <td style="width: 50%">
            Pegawai Negeri Sipil Yang Dinilai,
            <br/>
            <br/>
            <br/>
            <br/>
            {{ $header->Pegawai->nama }}
        </td>
    </tr>
</table>
