{{-- Example @url : https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage --}}
@extends('adminlte::page')

{{-- Allow DataTable --}}
@section('plugins.Datatables', true)

@section('title', 'List SKP Pegawai | ESKP BKD IAIN TERNATE')

@section('content_header')
<h1>Identitas Dosen</h1>
@stop

@section('content')


<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				@foreach($pegawai as $identitas)

				<!-- Profile Image -->
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle" img src=" https://i.ibb.co/k4Pd7Vy/59168519-10214108322686495-8229127055321595904-o.jpg" alt="User profile picture">
						</div>
						<h3 class="profile-username text-center">{{$identitas->Nama}} </h3>
						<p class="text-muted text-center">{{$identitas->NIDN}}</p>
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>NIP</b> <a class="float-right">{{$identitas->NIP}}</a>
							</li>
							<li class="list-group-item">
								<b>No. Sertifikat</b> <a class="float-right">{{$identitas->No_Sertifikat}}</a>
							</li>
							<li class="list-group-item">
								<b>No. HP</b> <a class="float-right">{{$identitas->No_HP}}</a>
							</li>
							<li class="list-group-item">
								<b>Email</b></b> <a class="float-right">{{$identitas->Email}}</a>
							</li>
						</ul>


					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>

			<div class="col-md-9">
				<div class="card">
					<div class="card-header p-2">
						<ul class="nav nav-pills">
							<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Biodata</a></li>
							<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Pendidikan</a></li>
							<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Periode</a></li>
						</ul>
					</div>

					<!-- /.card-header -->
					<div class="card-body">
						<div class="tab-content">
							<div class="active tab-pane" id="activity">
								<!-- /.card-header -->

								<div class="card-body">
									<div class="tab-content">
										<strong> Tempat, Tanggal Lahir</strong>
										<p class="text-muted">{{$identitas->Tempat_Lahir}}, {{$identitas->Tgl_Lahir}}</p>
										<hr>
										<strong>Jabatan Fungsional,Golongan</strong>
										<p class="text-muted">{{$identitas->Jab_Fungsional}}, {{$identitas->Golongan}} </p>
										<hr>
										<strong>Jenis Dosen</strong>
										<p class="text-muted">{{$identitas->Jenis}}</p>
										<hr>
										<strong>Program Studi</strong>
										<p class="text-muted">{{$identitas->Prog_Studi}}</p>
										<hr>
										<strong>Fakultas</strong>
										<p class="text-muted">{{$identitas->Fak_Dept}}</p>
										<hr>

										<strong>Perguruan Tinggi</strong>
										<p class="text-muted">{{$identitas->Nama_PT}}</p>
										<hr>
										<strong>Alamat Perguruan Tinggi</strong>
										<p class="text-muted">{{$identitas->Alamat_PT}}</p>
										<hr>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="timeline">
								<!-- The timeline -->
								<strong> S1</strong>
								<p class="text-muted">{{$identitas->S1}}</p>
								<hr>
								<strong>S2</strong>
								<p class="text-muted">{{$identitas->S2}}</p>
								<hr>
								<strong>S3</strong>
								<p class="text-muted">{{$identitas->S3}}</p>
								<hr>
								<strong>Bidang Ilmu</strong>
								<p class="text-muted">{{$identitas->Bidang_Ilmu}}</p>
								<hr>

							</div>
							<div class="tab-pane" id="settings">
								<strong>Tahun Akademik</strong>
								<p class="text-muted">{{$identitas->Tahun_Akademik}}</p>
								<hr>
								<strong>Semester</strong>
								<p class="text-muted">{{$identitas->Semester}}</p>
								<hr>
								<strong>Assesor 1</strong>
								<p class="text-muted">{{$identitas->Asesor1}}</p>
								<hr>
								<strong>Assesor 2</strong>
								<p class="text-muted">{{$identitas->Asesor2}}</p>
								<hr>

							</div>
						</div>
					</div>

				</div>
			</div>
			@include('alert')
			@endforeach
			@stop





			<!-- jQuery -->
			<script src="../../plugins/jquery/jquery.min.js"></script>
			<!-- Bootstrap 4 -->
			<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
			<!-- AdminLTE App -->
			<script src="../../dist/js/adminlte.min.js"></script>
			<!-- AdminLTE for demo purposes -->
			<script src="../../dist/js/demo.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</div>
	</div>
</section>
</body>

</html>