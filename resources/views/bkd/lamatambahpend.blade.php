{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Bidang Pendidikan| ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Input BKD Bidang Pendidikan</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
    </div>
    <div class="card-body">
    <form action="/bkd/tambahpend" method="POST">
        {{csrf_field()}}
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Jenis Kegiatan</label>
      <textarea name="Jenis_Kegiatan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Bukti Penugasan</label>
      <textarea name="Bukti_Penugasan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">SKS</label>
        <input name="SKS" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
<script>
$("#table").DataTable();
</script>
@stop
