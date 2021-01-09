{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'Laporan Kinerja Dosen | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>LKD IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <h3 class="d-inline-block">Detail LKD</h3>
        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">
            <i class="fas fa-backward"></i> Kembali
        </a>
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>NIP</th>
                        <td>{{ $header->Pegawai->nip }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $header->Pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <td>{{ $header->Pegawai->biro }}</td>
                    </tr>
                    <tr>
                        <th>Pangkat/Golongan Ruang</th>
                        <td>{{ $header->Pegawai->pangkat."/".$header->Pegawai->golongan}}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $header->Pegawai->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $header->tanggal_awal }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Akhir</th>
                        <td>{{ $header->tanggal_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Status LKD</th>
                        <td>{{ $header->getStatusString() }}</td>
                    </tr>
                    @if ($header->getStatusString() == "Valid")
                    <tr>
                        <th>Divalidasi Oleh</th>
                        <td>{{ $header->Validator->nama }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>NIP</th>
                        <td>{{ $header->Atasan->nip }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $header->Atasan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <td>{{ $header->Atasan->biro }}</td>
                    </tr>
                    <tr>
                        <th>Pangkat/Golongan Ruang</th>
                        <td>{{ $header->Atasan->pangkat."/".$header->Atasan->golongan}}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $header->Atasan->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengesahan</th>
                        <td>{{ $header->tanggal_pengesahan ?? "-" }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 mb-3">
                {{-- Hanya tampilkan kalau LKD sudah validated --}}
                @if ($header->status_bkd == 3 && $isValidasi == false)
                <a href="{{ url('/bkd/'.$header->id.'/print') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-print"></i> Print LKD
                </a>
                @endif
                @if ($header->status_bkd == 0 && $isValidasi == false)
                <a href="{{ url('/bkd/'.$header->id.'/detail/add') }}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> Tambah LKD
                </a>


                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PUT")
                    @csrf
                    <button type="submit" class="btn btn-primary">Ajukan Validasi</button>
                </form>
                @endif
                {{-- Kalau untuk Validasi Maka --}}
                @if ($isValidasi AND $header->status_bkd == 1)
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("PATCH")
                    @csrf
                    <input type="hidden" name='type' value='lengkap'>
                    <button type="submit" class="btn btn-success">Data Lengkap</button>
                </form>
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("DELETE")
                    @csrf
                    <input type="hidden" name='type' value='kembalikan'>
                    <button type="submit" class="btn btn-danger">Kembalikan - Belum Lengkap</button>
                </form>
                @endif

                @if ($isPengesahan AND $header->status_bkd == 2)
                {{-- Kalau Pengesahan --}}
                <form method="POST" class="d-inline-block float-right mr-2">
                    @method("POST")
                    @csrf
                    <input type="hidden" name='type' value='lengkap'>
                    <button type="submit" class="btn btn-success">Sah kan LKD</button>
                </form>
                @endif
            </div>
        </div>

        <h3>LKD</h3>
        <form method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table responsive nowrap" style="width:100%" id="lkd">
                    <thead>

                        <tr>
                            <th>NO</th>
                            <th>Bidang</th>
                            </th>
                            <th>Jenis Kegiatan</th>
                            <th>Bukti Penugasan</th>
                            <th>SKS</th>

                            <th>Masa Penugasan</th>
                            <th>Bukti Dokumen</th>
                            <th>SKS</th>

                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i<count($detail); $i++) <tr>
                            <td>{{ $i+1 }} </td>
                            <td>{{ $detail[$i]->Bidang ?? "-" }}</td>
                            <td>{{ $detail[$i]->Jenis_Kegiatan }}</td>
                            <td>{{ $detail[$i]->Bukti_Penugasan }}</td>
                            <td>{{ $detail[$i]->SKS_RBKD ?? "-"}}</td>

                            <td>
                                <input type="text" class="form-control" name="Masa_Penugasan[]" value="{{ old('Masa_Penugasan['.$i.']') }}" style="max-width:300px">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="Bukti_Dokumen[]" value="{{ old('Bukti_Dokumen['.$i.']') }}" style="max-width:300px">

                            </td>
                            <td>
                                <input type="text" class="form-control" name="SKS_LKD[]" value="{{ old('SKS_LKD['.$i.']') }}" style="max-width:60px">
                            </td>

                            </tr>
                            @endfor
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary float-right mt-2">Simpan LKD</button>
            </div>
        </form>
        <br />

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