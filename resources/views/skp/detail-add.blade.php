{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

@section('title', 'Input SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Input Detail SKP</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        Input Detail SKP Pegawai PNS
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
                <label>Tugas Jabatan</label>
                <input type="text" name="tugas_jabatan" class="form-control">
            </div> 
            <div class="col-12 col-md-6">
                <label>Angka Kredit</label>
                <input type="number" min="0" name="angka_kredit" class="form-control">
            </div>
            <div class="col-12 col-md-5">
                <label>Kuantitas/Output</label>
                <input type="number" min="0" name="kuant" class="form-control"> 
            </div>
            <div class="col-md-1 d-sm-none d-md-block"><div class="mb-5" style="margin-bottom: 2.3rem !important;"></div>/</div>
            <div class="col-12 col-md-3">
                <label> </label>
                <input type="text" min="0" name="output" class="form-control mt-1" placeholder="dokumen,laporan,buah,dsb">
            </div>
            <div class="col-12">
                <label>Kualitas Mutu</label>
                <input type="text" min="0" name="kual_mutu" class="form-control">
            </div>
            <div class="col-12 col-md-5">
                <label>Waktu/Satuan</label>
                <input type="number" min="0" name="waktu" class="form-control"> 
            </div>
            <div class="col-md-1 d-sm-none d-md-block"><div class="mb-5" style="margin-bottom: 2.3rem !important;"></div>/</div>
            <div class="col-12 col-md-3">
                <label> </label>
                <select class="form-control mt-1" name="satuan">
                    <option value=0>Silahkan pilih Waktu</option>
                    <option>Bulan</option>
                    <option>Minggu</option>
                    <option>Hari</option>
                </select>
            </div>
            <div class="col-12">
                <label>Biaya</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp.</div>
                  </div>
                  <input type="number" name="biaya" min="0" class="form-control" placeholder="ex 100.000">
                </div>
            </div>
        </div>
        <br/>
        <br>
        <button class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
        <a href="{{ url('/skp/'.$header->id."/detail") }}" class="btn btn-danger"><i class="fas fa-backward"></i> Kembali</a>
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
