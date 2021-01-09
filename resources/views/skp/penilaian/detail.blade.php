{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Realisasi SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Realisasi SKP IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <h3 class="d-inline-block">Detail SKP - Realisasi</h3>
        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">
            <i class="fas fa-backward"></i> Kembali
        </a>
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr><th>NIP</th><td>{{ $header->Pegawai->nip }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $header->Pegawai->nama }}</td></tr>
                    <tr><th>Unit Kerja</th><td>{{ $header->Pegawai->biro }}</td></tr>
                    <tr><th>Pangkat/Golongan Ruang</th><td>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan}}</td></tr>
                    <tr><th>Jabatan</th><td>{{ $header->Pegawai->jabatan }}</td></tr>
                    <tr><th>Tanggal Mulai</th><td>{{ $header->tanggal_awal }}</td></tr>
                    <tr><th>Tanggal Akhir</th><td>{{ $header->tanggal_akhir }}</td></tr>
                    <tr><th>Status SKP</th><td>{{ $header->getStatusString() }}</td></tr>
                    @if ($header->getStatusString() == "Valid")
                    <tr><th>Divalidasi Oleh</th><td>{{ $header->Validator->nama }}</td></tr>
                    @endif
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr><th>NIP</th><td>{{ $header->Atasan->nip }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $header->Atasan->nama }}</td></tr>
                    <tr><th>Unit Kerja</th><td>{{ $header->Atasan->biro }}</td></tr>
                    <tr><th>Pangkat/Golongan Ruang</th><td>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan}}</td></tr>
                    <tr><th>Jabatan</th><td>{{ $header->Atasan->jabatan }}</td></tr>
                    <tr><th>Tanggal Pengesahan</th><td>{{ $header->tanggal_pengesahan ?? "-" }}</td></tr>
                </table>
            </div>
            <div class="col-12 mb-3">
                {{-- Hanya tampilkan kalau SKP sudah validated --}}
                @if ($header->status_skp == 3 && $isValidasi == false)
                <a href="{{ url('/skp/'.$header->id.'/print') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-print"></i> Print SKP
                </a>           
                @endif
                @if ($header->status_skp == 0 && $isValidasi == false)
                <a href="{{ url('/skp/'.$header->id.'/detail/add') }}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> Tambah Tugas Jabatan
                </a>
                <a href="{{ url('/skp/'.$header->id.'/detail/add-tgstambahan') }}" class="btn btn-info mr-2 float-right">
                    <i class="fas fa-plus"></i> Tambah Tugas Tambahan 
                </a>

                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PUT")
                    @csrf
                    <button type="submit" class="btn btn-primary">Ajukan Validasi</button>
                </form>
                @endif
                {{-- Kalau untuk Validasi Maka --}}
                @if ($isValidasi AND $header->status_skp == 1)
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PATCH")
                    @csrf
                    <input type="hidden" name='type' value='lengkap'>
                    <button type="submit" class="btn btn-success">Data Lengkap</button>
                </form>
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("DELETE")
                    @csrf
                    <input type="hidden" name='type' value='kembalikan'>
                    <button type="submit" class="btn btn-danger">Kembalikan - Belum Lengkap</button>
                </form>
                @endif

                @if ($isPengesahan AND $header->status_skp == 2)
                {{-- Kalau Pengesahan --}}
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("POST")
                    @csrf
                    <input type="hidden" name='type' value='lengkap'>
                    <button type="submit" class="btn btn-success">Sah kan SKP</button>
                </form>
                @endif
            </div>
        </div>

        <h3>Tugas Jabatan</h3>
        <form method="POST">
        @csrf
        <div class="table-responsive">
        <table class="table responsive nowrap" style="width:100%" id="tugasJabatan">
            <thead>
                <tr>
                    <th rowspan=2>No</th>
                    <th rowspan=2>Tugas Jabatan</th>
                    <th colspan=5 class="text-center">Target</th>
                    <th colspan=5 class="text-center">Realisasi</th>
                </tr>
                <tr>
                    <th>Angka<br/>Kredit</th>
                    <th>Kuat/<br/>Output</th>
                    <th>Kual/<br/>Mutu</th>
                    <th>Waktu</th>
                    <th>Biaya</th>
                    <th>Angka<br/>Kredit</th>
                    <th>Kuat/<br/>Output</th>
                    <th>Kual/<br/>Mutu</th>
                    <th>Waktu</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i<count($detail); $i++) 
                <tr>
                    <td>{{ $i+1 }} </td>
                    <td>{{ $detail[$i]->tugas_jabatan ?? "-" }}</td>
                    <td>{{ $detail[$i]->angka_kredit }}</td>
                    <td>{{ $detail[$i]->kuant_output ?? "-" }}</td>
                    <td>{{ $detail[$i]->kual_mutu ?? "-" }}</td>
                    <td>{{ $detail[$i]->waktu ?? "-" }}</td>
                    <td>{{ $detail[$i]->biaya ?? "-" }}</td>
                    <td>
                        <input type="hidden" name="id[]" value="{{ $detail[$i]->id }}">
                        <input type="text" class="form-control" name="angka_kredit[]" value="{{ old('angka_kredit['.$i.']') ?? (isset($nilaiJabatan[$i])) ? $nilaiJabatan[$i]->angka_kredit : "" }}" style="max-width:60px">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="kuant_output[]" value="{{ old('kuant_output['.$i.']') ?? (isset($nilaiJabatan[$i])) ? $nilaiJabatan[$i]->kuant_output  : ""}}" style="max-width:60px">
                        /{{ explode("/",$detail[$i]->kuant_output)[1] ?? "-" }}
                    </td>
                    <td>
                        <input type="text" class="form-control" name="kual_mutu[]" value="{{ old('kual_mutu['.$i.']') ?? (isset($nilaiJabatan[$i])) ? $nilaiJabatan[$i]->kual_mutu  : ""}}" style="max-width:60px">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="waktu[]" value="{{ old('waktu['.$i.']') ?? (isset($nilaiJabatan[$i])) ? $nilaiJabatan[$i]->waktu  : ""}}" style="max-width:60px">
                        /{{ explode("/",$detail[$i]->waktu)[1] ?? "-" }}
                    </td>
                    <td>
                        <input type="text" class="form-control" name="biaya[]" value="{{ old('biaya['.$i.']') ?? (isset($nilaiJabatan[$i])) ? $nilaiJabatan[$i]->biaya : "" }}" style="max-width:60px">
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary float-right mt-2">Simpan Nilai Jabatan</button>
        </div>
        </form>
        <br/>
        <h3>Tugas Tambahan</h3>
        <div class="table-responsive">
        <table class="table responsive nowrap" style="width:100%" id="tugasTambahan">
            <thead>
                <th>No</th>
                <th>Deskripsi Tugas Tambahan</th>
                <th>Nomor SK</th>
            </thead>
            <tbody>
                @for ($i = 0; $i<count($detailTambahan); $i++) 
                <tr>
                    <td>{{ $i+1 }} </td>
                    <td>{{ $detailTambahan[$i]->tugas_tambahan ?? "-" }}</td>
                    <td>{{ $detailTambahan[$i]->nomor_sk ?? "-" }}</td>
                </tr>
                @endfor
                <tr>
                    <td class="d-none">{{ $i }}</td>
                    <td class="d-none"></td>
                    <td class="text-right" colspan=3><b>Total Nilai Tugas Tambahan : {{ $nilaiTugasTambahan }}</b></td>
                </tr>
            </tbody>
        </table>
        </div>
        <h3 class="mt-5">Penilaian Sikap Kerja</h3>
        <form method="POST">
            @method("PATCH")
            @csrf
            <div class="form-group row">
                <label class="col-4">Orientasi Pelayanan</label>
                <input type="number" name="pelayanan" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Intergritas</label>
                <input type="number" name="intergritas" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Komitmen</label>
                <input type="number" name="komitmen" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Disiplin</label>
                <input type="number" name="disiplin" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Kerjasama</label>
                <input type="number" name="kerjasama" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Kepemimpinan</label>
                <input type="number" name="kepemimpinan" min=0 max=100 class="form-control hitung col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Jumlah</label>
                <input type="number" disabled name="jumlah" min=0 max=100 class="form-control col-8">
            </div>
            <div class="form-group row">
                <label class="col-4">Rata-Rata</label>
                <input type="number" disabled name="rataan" min=0 max=100 class="form-control col-8">
            </div>
            <button type="submit" class="btn btn-primary float-right mt-2">Simpan Nilai Sikap</button>
        </form>
    </div>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
<script>
$("#tugasTambahan,#tugasJabatan").DataTable();
$(function() {
    function calculate() {
        var data = $(".hitung");
        var total = 0;
        for(var i = 0; i< data.length; i++) {
            if (!isNaN(parseInt($(data[i]).val())))
                total += parseInt($(data[i]).val()); 
        }
        console.log(total);
        console.log(total/6);
        // set jumlah
        $("input[name='jumlah']").val(total);
        // set rata-rata
        $("input[name='rataan']").val((total/6).toFixed(2));
    }
    $(".hitung").change(calculate);
});
</script>
@stop
