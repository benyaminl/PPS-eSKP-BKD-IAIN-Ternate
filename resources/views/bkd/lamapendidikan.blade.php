{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Bidang Pendidikan| ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Input BKD</h1>
@stop

@section('content')
<div class="card">
    @if(session('sukses'))
    <div class="alert alert-primary" role="alert">
  {{session('sukses')}}
</div>
@endif
    @include('alert')
    <div class="card-header">
       <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-plus"></i> Tambah Data
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input RBKD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="/bkd/create" method="POST">
            {{csrf_field()}}
            <div class="form-group">
            <label for="exampleFormControlSelect1">Bidang</label>
            <select name="Bidang" class="form-control" id="exampleFormControlSelect1">
              <option value="Pendidikan">Bidang Pendidikan</option>
              <option value="Penelitian">Bidang Penelitian</option>
              <option value="Pengabdian">Bidang Pengabdian Masyarakat</option>
              <option value="Kinerja Penunjang">Bidang Kinerja Penunjang</option>
              <option value="Kewajiban Profesor">Bidang Kewajiban Profesor</option>
            </select>
          </div>

            <div class="form-group">
            <label for="exampleFormControlTextarea1">Jenis Kegiatan</label>
            <textarea name="Jenis_Kegiatan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Bukti Penugasan</label>
            <textarea name="Bukti_Penugasan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">SKS RBKD</label>
            <input name="SKS_RBKD" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="SKS RBKD">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      </div>
    </div>
  </div>
</div>
</div>
</form>

    <div class="card-body">
        <div class=" table-responsive">
          <table class="table table-hover responsive nowrap" style="width:100%" id="table">
              <thead>
                  <th>No</th>
                  <th>Bidang</th>
                  <th>Jenis Kegiatan</th>
                  <th>Bukti Penugasan</th>
                  <th>SKS RBKD</th>
                  <th class="action">Action</th>
              </thead>
              <tbody>
                  @foreach($data_rbkd as $rbkd) 
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rbkd->Bidang}}</td>
                      <td class="text-wrap" style="max-width: 120px">{{$rbkd->Jenis_Kegiatan}}</td>
                      <td class="text-wrap" style="max-width: 120px">{{$rbkd->Bukti_Penugasan}}</td>
                      <td>{{$rbkd->SKS_RBKD}}</td>
                      <td>
                      <a href="/bkd/pendidikan/{{$rbkd->id}}/edit" class= "btn btn-warning btn-sm">Edit</a>
                      <a href="/bkd/pendidikan/{{$rbkd->id}}/delete" class= "btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Dihapus ?')">Delete</a>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
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
