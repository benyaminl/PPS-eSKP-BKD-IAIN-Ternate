{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'List BKD | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>Detail BKD IAIN Ternate</h1>
@stop

@section('content')
<div class="card">
    @include('alert')
    <div class="card-header">
        <h3 class="d-inline-block">Detail BKD</h3>
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
                        <th>Fakultas</th>
                        <td>{{ $header->Pegawai->fak_dept }}</td>
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
                        <th>Status BKD</th>
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
                        <th>Fakultas</th>
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
                {{-- Hanya tampilkan kalau BKD sudah validated --}}
                @if ($header->status_skp == 3 && $isValidasi == false)
                <a href="{{ url('/bkd/'.$header->id.'/print') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-print"></i> Print BKD
                </a>
                @endif
                @if ($header->status_bkd == 0 && $isValidasi == false)
                <a href="{{ url('/bkd/'.$header->id.'/detail/add') }}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> Tambah BKD
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
                    <button type="submit" class="btn btn-success">Sah kan BKD</button>
                </form>
                @endif
            </div>
        </div>

        <h3>RBKD</h3>
        <div class="table-responsive">
            <table class="table responsive nowrap" style="width:100%" id="tugasJabatan">
                <thead>
                    <th>No</th>
                    <th>Bidang</th>
                    <th>Jenis_Kegiatan</th>
                    <th>Bukti_Penugasan</th>
                    <th>SKS</th>

                    <th class="action">Action</th>
                </thead>
                <tbody>
                    @for ($i = 0; $i<count($detail); $i++) <tr>
                        <td>{{ $i+1 }} </td>
                        <td>{{ $detail[$i]->Bidang ?? "-" }}</td>
                        <td>{{ $detail[$i]->Jenis_Kegiatan }}</td>
                        <td>{{ $detail[$i]->Bukti_Penugasan ?? "-" }}</td>
                        <td>{{ $detail[$i]->SKS_RBKD ?? "-" }}</td>

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
        </div>
        <br />

    </div>
</div>
</div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@section('js')
<script>
    $("#Bidang").DataTable();
</script>
@stop