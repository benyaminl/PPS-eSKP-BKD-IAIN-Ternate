{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Input LKD| ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>Input LKD</h1>
@stop

@section('content')
<div class="card">
  @if(session('sukses'))
  <div class="alert alert-primary" role="alert">
    {{session('sukses')}}
  </div>
  @endif
  @include('alert')



  <div class="card-body">
    <table class="table table-hover responsive nowrap" style="width:100%" id="table">
      <thead>
        <!--tampilkan data RBKD-->
        <th>No</th>
        <th>Bidang</th>
        <th>Jenis_Kegiatan</th>
        <th>Bukti_Penugasan</th>
        <th>SKS RBKD</th>

        <!--Input LKD-->
        <th>Masa Penugasan</th>
        <th>Bukti Dokumen


        </th>
        <th>SKS LKD</th>
        <th class="action">Action</th>
      </thead>
      <tbody>
        {{-- @foreach(@) --}}
        @foreach($add_lkd as $lkd)
        <tr>
          <td>{{$lkd->No}}</td>
          <td>{{$lkd->Masa_Penugasan}}</td>
          <td>{{$lkd->Bukti_Dokumen}}</td>
          <td>{{$lkd->SKS_LKD}}</td>
          <td>
            <a href="/lkd/add/{{$lkd->No}}/add" class=" btn btn-success btn-sm">Add</a>
            <a href="" class="btn btn-warning btn-sm">Edit</a>
            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Dihapus ?')">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
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