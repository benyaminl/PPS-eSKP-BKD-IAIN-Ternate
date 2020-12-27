{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

@section('title', 'Input SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Input SKP</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        Input SKP Pegawai PNS
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
            <input type="date" name="tanggal-mulai" value="{{ $start }}" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal-selesai" value="{{ $end }}" class="form-control">
        </div> 
        </div>
        <button class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
        <a href="{{ url('/skp') }}" class="btn btn-danger"><i class="fas fa-backward"></i> Kembali</a>
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
