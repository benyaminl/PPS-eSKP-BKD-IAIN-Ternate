{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'List BKD | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>BKD IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <form method="GET" class="d-inline-block" style="max-width: 90%">
            <div class="d-md-inline-block ml-md-2 mb-2 d-block" style="min-width: 285px">
                <label class="d-inline-block mr-2">Tanggal Start</label>
                <input type="date" class="d-inline-block form-control" style="max-width: 59%" value="{{ $start }}" name="tanggal-start">
            </div>
            <div class="d-md-inline-block ml-md-2 mb-2 d-block" style="min-width: 285px">
                <label class="d-inline-block mr-2">Tanggal End</label>
                <input type="date" class="d-inline-block form-control" style="max-width: 59%" value="{{ $end }}" name="tanggal-end">
            </div>
            <div class="d-inline-block ml-3 mb-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
        <a href="{{ url('/bkd/add') }}" class="btn btn-success float-right">
            <i class="fas fa-plus"></i> Add
        </a>
        </form>
    </div>
    <div class="card-body">
        <table class="table responsive nowrap" style="width:100%" id="table">
            <thead>
                <th>ID</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Pengesahan</th>
                <th>Status</th>
                <th>Fakultas</th>
                <th class="action">Action</th>
            </thead>

            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $d->id }} </td>
                    <td>{{ ($d->tanggal_pengajuan != null) ? $d->tanggal_pengajuan->format("d-m-Y H:i") : "-" }}</td>
                    <td>{{ ($d->tanggal_pengesahan != null) ? $d->tanggal_pengesahan->format("d-m-Y H:i") : "-" }}</td>
                    <td>{{ $d->getStatusString() }}</td>
                    <td>{{ $d->Pegawai->fak_dept }}</td>
                    <td>
                        <a href="{{ url("bkd/".$d->id."/detail") }}" class="btn btn-primary">Detail</a>
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