{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

@section('title', 'Input BKD | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>Input BKD</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        Input BKD
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
                    <th>Fakultas</th>
                    <td>{{ $fak_dept }}</td>
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
            <a href="{{ url('/bkd') }}" class="btn btn-danger"><i class="fas fa-backward"></i> Kembali</a>
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