{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'List SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
    <h1>Detail SKP IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <h3 class="d-inline-block">Detail SKP</h3>
        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">
            <i class="fas fa-backward"></i> Kembali
        </a>
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr><th>NIP</th><td>{{ $header->Pegawai->nip }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $header->Pegawai->nama }}</td></tr>
                    <tr><th>Unit Kerja</th><td>{{ $header->Pegawai->biro }}</td></tr>
                    <tr><th>Pangkat/Golongan Ruang</th><td>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan}}</td></tr>
                    <tr><th>Jabatan</th><td>{{ $header->Pegawai->jabatan }}</td></tr>
                    <tr><th>Tanggal Mulai</th><td>{{ $header->tanggal_awal }}</td></tr>
                    <tr><th>Tanggal Akhir</th><td>{{ $header->tanggal_akhir }}</td></tr>
                    <tr><th>Status SKP</th><td>{{ $header->getStatusString() }}</td></tr>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr><th>NIP</th><td>{{ $header->Atasan->nip }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $header->Atasan->nama }}</td></tr>
                    <tr><th>Unit Kerja</th><td>{{ $header->Atasan->biro }}</td></tr>
                    <tr><th>Pangkat/Golongan Ruang</th><td>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan}}</td></tr>
                    <tr><th>Jabatan</th><td>{{ $header->Atasan->jabatan }}</td></tr>
                    <tr><th>Tanggal Pengesahan</th><td>{{ $header->tanggal_pengesahan ?? "-" }}</td></tr>
                </table>
            </div>
            <div class="col-12 mb-3">
                {{-- Hanya tampilkan kalau SKP sudah validated --}}
                @if ($header->status_skp == 3)
                <a href="{{ url('/skp/'.$header->id.'/print') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-print"></i> Print SKP
                </a>           
                @endif
                @if ($header->status_skp == 0)
                <a href="{{ url('/skp/'.$header->id.'/detail/add') }}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> Tambah Tugas Jabatan
                </a>
                <a href="{{ url('/skp/'.$header->id.'/detail/add-tgstambahan') }}" class="btn btn-info mr-2 float-right">
                    <i class="fas fa-plus"></i> Tambah Tugas Tambahan 
                </a>

                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PUT")
                    @csrf
                    <button type="submit" class="btn btn-primary">Ajukan Validasi</button>
                </form>
                @endif
                {{-- Kalau untuk Validasi Maka --}}
                @if ($isValidasi)
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PUT")
                    @csrf
                    <button type="submit" class="btn btn-success">Data Lengkap</button>
                </form>
                @endif
            </div>
        </div>

        <h3>Tugas Jabatan</h3>
        <table class="table responsive nowrap" style="width:100%" id="tugasJabatan">
            <thead>
                <th>No</th>
                <th>Tugas Jabatan</th>
                <th>Angka Kredit</th>
                <th>Kuat/Output</th>
                <th>Kual/Mutu</th>
                <th>Waktu</th>
                <th>Biaya</th>
                <th class="action">Action</th>
            </thead>
            <tbody>
                @for ($i = 0; $i<count($detail); $i++) 
                <tr>
                    <td>{{ $i+1 }} </td>
                    <td>{{ $detail[$i]->tugas_jabatan ?? "-" }}</td>
                    <td>{{ $detail[$i]->kuant_output ?? "-" }}</td>
                    <td>{{ $detail[$i]->angka_kredit }}</td>
                    <td>{{ $detail[$i]->kual_mutu ?? "-" }}</td>
                    <td>{{ $detail[$i]->waktu ?? "-" }}</td>
                    <td>{{ $detail[$i]->biaya ?? "-" }}</td>
                    <td>
                        <form method="POST">
                            {{-- Method Spoff --}} 
                            @method("DELETE")
                            @csrf
                            <input type="hidden" value='{{ $detail[$i]->id }}' name='id'>
                            <button class="btn btn-danger" type=submit><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
        <br/>
        <h3>Tugas Tambahan</h3>
        <table class="table responsive nowrap" style="width:100%" id="tugasTambahan">
            <thead>
                <th>No</th>
                <th>Deskripsi Tugas Tambahan</th>
                <th>Nomor SK</th>
                <th class="action">Action</th>
            </thead>
            <tbody>
                @for ($i = 0; $i<count($detailTambahan); $i++) 
                <tr>
                    <td>{{ $i+1 }} </td>
                    <td>{{ $detailTambahan[$i]->tugas_tambahan ?? "-" }}</td>
                    <td>{{ $detailTambahan[$i]->nomor_sk ?? "-" }}</td>
                    <td>
                        <form method="POST">
                            {{-- Method Spoff --}} 
                            @method("DELETE")
                            @csrf
                            <input type="hidden" value='{{ $detailTambahan[$i]->id }}' name='id'>
                            <input type="hidden" value='tugas-tambahan' name='type'>
                            <button class="btn btn-danger" type=submit><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endfor
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
$("#tugasTambahan,#tugasJabatan").DataTable();
</script>
@stop
