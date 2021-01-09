{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

@section('title', 'Input BKD | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>Input Detail BKD</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        Input Detail BKD
    </div>
    <div class="card-body">
        <form method="POST">
            @csrf
            <table class="table table-borderless">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $nama }}</td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td>{{ $departemen }}</td>
                </tr>
            </table>
            <div class="row">
                <div class="form-group col-6">
                    <label>Tanggal Mulai</label>
                    <input disabled type="date" name="tanggal-mulai" value="{{ $start }}" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label>Tanggal Selesai</label>
                    <input disabled type="date" name="tanggal-selesai" value="{{ $end }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label>Bidang</label>
                    <input type="text" name="Bidang" value="{{ old('bidang') }}" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                    <label>Jenis Kegiatan</label>
                    <input type="text" min="0" name="Jenis_Kegiatan" value="{{ old('Jenis_Kegiatan') ?? 0 }}" class="form-control">
                </div>
                <div class="col-12 col-md-5">
                    <label>Bukti Penugasan</label>
                    <input type="text" min="0" name="Bukti_Penugasan" value="{{ old('Bukti_Penugasan') }}" class="form-control">
                </div>
                <div class="col-md-1 d-sm-none d-md-block">
                    <div class="mb-5" style="margin-bottom: 2.3rem !important;"></div>/
                </div>
                <div class="col-12 col-md-3">
                    <label> SKS</label>
                    <input type="text" min="0" name="output" value="{{ old('output') }}" class="form-control mt-1" placeholder="dokumen,laporan,buah,dsb">
                </div>


            </div>
            <br />
            <br>
            <button class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
            <a href="{{ url('/bkd/'.$header->id."/detail") }}" class="btn btn-danger"><i class="fas fa-backward"></i> Kembali</a>
        </form>
    </div>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

{{-- @section('js')
<script>
$("#table").DataTable();
</script>
@stop --}}