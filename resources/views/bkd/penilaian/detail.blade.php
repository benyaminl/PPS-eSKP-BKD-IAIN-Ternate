{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Laporan Kinerja Dosen | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>LKD IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <h3 class="d-inline-block">Detail LKD</h3>
        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">
            <i class="fas fa-backward"></i> Kembali
        </a>
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>NIP</th>
                        <td>{{ $header->Pegawai->nip }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $header->Pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <td>{{ $header->Pegawai->biro }}</td>
                    </tr>
                    <tr>
                        <th>Pangkat/Golongan Ruang</th>
                        <td>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan}}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $header->Pegawai->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $header->tanggal_awal }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Akhir</th>
                        <td>{{ $header->tanggal_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Status LKD</th>
                        <td>{{ $header->getStatusString() }}</td>
                    </tr>
                    @if ($header->getStatusString() == "Valid")
                    <tr>
                        <th>Divalidasi Oleh</th>
                        <td>{{ $header->Validator->nama }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>NIP</th>
                        <td>{{ $header->Atasan->nip }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $header->Atasan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <td>{{ $header->Atasan->biro }}</td>
                    </tr>
                    <tr>
                        <th>Pangkat/Golongan Ruang</th>
                        <td>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan}}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $header->Atasan->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengesahan</th>
                        <td>{{ $header->tanggal_pengesahan ?? "-" }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 mb-3">
                {{-- Hanya tampilkan kalau LKD sudah validated --}}
                @if ($header->status_skp == 3 && $isValidasi == false)
                <a href="{{ url('/skp/'.$header->id.'/print') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-print"></i> Print SKP
                </a>
                @endif
                @if ($header->status_lkd == 0 && $isValidasi == false)
                <a href="{{ url('/lkd/'.$header->id.'/detail/add') }}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> Tambah LKD
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
                    <button type="submit" class="btn btn-success">Sah kan LKD</button>
                </form>
                @endif
            </div>
        </div>

        <h3>LKD</h3>
        <form method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table responsive nowrap" style="width:100%" id="lkd">
                    <thead>
                        <tr>
                            <th rowspan=2>No</th>
                            <th rowspan=2>LKD</th>
                            <th colspan=5 class="text-center">Target</th>
                            <th colspan=5 class="text-center">Realisasi</th>
                        </tr>
                        <tr>
                            <th>Angka<br />Kredit</th>
                            <th>Kuat/<br />Output</th>
                            <th>Kual/<br />Mutu</th>
                            <th>Waktu</th>
                            <th>Biaya</th>
                            <th>Angka<br />Kredit</th>
                            <th>Kuat/<br />Output</th>
                            <th>Kual/<br />Mutu</th>
                            <th>Waktu</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i<count($detail); $i++) <tr>
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
        <br />

    </div>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
<script>
    $("#tugasTambahan,#tugasJabatan").DataTable();
</script>
@stop