{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Bidang Pendidikan| ESKP BKD IAIN TERNATE')

@section('content_header')
@stop
@section('content')
<div class="container">
  <h1>Edit RBKD</h1>
    @if(session('sukses'))
    <div class="alert alert-primary" role="alert">
  {{session('sukses')}}
</div>
@endif

    <div class="card-header">
    </div>
  </div>
</div>
</div>

    <div class="card-body">
          <form action="/bkd/pendidikan/{{$dosen->No}}/update" method="POST">
            {{csrf_field()}}
             <div class="form-group">
            <label for="exampleInputEmail1">Bidang</label>
            <input name="Bidang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="SKS" value="{{$dosen->Bidang}}">
          </div>

            <div class="form-group">
            <label for="exampleFormControlTextarea1">Jenis Kegiatan</label>
            <textarea name="Jenis_Kegiatan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$dosen->Jenis_Kegiatan}}</textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Bukti Penugasan</label>
            <textarea name="Bukti_Penugasan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$dosen->Bukti_Penugasan}}</textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">SKS RBKD</label>
            <input name="SKS_RBKD" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="SKS RBKD" value="{{$dosen->SKS_RBKD}}">
          </div>
          <button type="submit" class="btn btn-warning">Update</button>
         </form>
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
