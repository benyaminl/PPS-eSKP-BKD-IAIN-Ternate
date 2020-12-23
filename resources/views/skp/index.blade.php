{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

@section('title', 'List SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>SKP IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <a href="{{ url('/skp/add') }}" class="btn btn-success float-right">
            <i class="fas fa-plus"></i> Add
        </a>
    </div>
    <div class="card-body">
        <table class="table responsive nowrap" style="width:100%" id="table">
            <thead>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th class="action">Action</th>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop --}}