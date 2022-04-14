@extends('layouts.app')
@section('title', 'Pembuatan User')
@section('content-title', 'Pembuatan User')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function() {

		$('.tanggal').datetimepicker({
			timepicker: false,
			format: 'Y/m/d',
		});

	});


	$(document).ready(function() {
		$('body').toggleClass('sidebar-collapse');
	});
</script>
@endsection
@section('button-title')
<a class="btn btn-sm btn-secondary" href="{{ action('UserController@index') }}"  data-toggle="tooltip" data-placement="top"
title="Tambah">Kembali</a>
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-sm-8">
		<div class="card">
			<div class="card-header">
				Informasi Pribadi
			</div>
			<div class="card-body">
				<form method="post" action="{{ action('UserController@store') }}" enctype='multipart/form-data'>
					@csrf

					<div class="form-group row align-items-center">
						<div class="col-sm-12">
							<div class="form-group row">
								<label for="tempat_lahir" class="col-sm-2 col-form-label">NIK</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" id="nik" name="nik">
								</div>
								<label for="tanggal_lahir" class="col-sm-2 col-form-label">Nama</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="nama" name="nama">
								</div>
							</div>
							<div class="form-group row">
								<label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="tempat" name="tempat" autocomplete="off">
								</div>
								<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal lahir</label>
								<div class="col-sm-4">
									<input type="text" class="form-control tanggal" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off">
								</div>
							</div>
							<div class="form-group row">
								<label for="tempat_lahir" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="pendidikan_terakhir" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
								<div class="col-sm-4">
									<select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
										@foreach ($pendidikanAkhir as $key => $val)
										<option value="{{ $key }}">{{ $val }}
										</option>
										@endforeach
									</select>
								</div>
								<label for="agama" class="col-sm-2 col-form-label">Agama</label>
								<div class="col-sm-4">
									<select class="form-control" id="agama" name="agama">
										@foreach ($agama as $key => $val)
										<option value="{{ $key }}">{{ $val }}
										</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="status" class="col-sm-2 col-form-label">Status</label>
								<div class="col-sm-4">
									<select class="form-control" id="status" name="status">
										@foreach ($statusPernikahan as $key => $val)
										<option value="{{ $key }}">
										{{ $val }}</option>
										@endforeach
									</select>
								</div>
								<label for="no_hp" class="col-sm-2 col-form-label">No. Hp (Whatsapp)</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" id="no_hp" name="no_hp">
								</div>
							</div>
							<div class="form-group row">
								<label for="no_hp_darurat" class="col-sm-2 col-form-label">Kontak Darurat</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" id="no_hp_darurat"
									name="no_hp_darurat">
								</div>
								<label for="email" class="col-sm-2 col-form-label">Foto</label>
								<div class="col-sm-4">
									<input type="file" class="form-control-file" name="foto">
								</div>
							</div>
							<div class="form-group row">
								<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
								<div class="col-sm-4">
									<select class="form-control" id="jabatan" name="jabatan">
										@foreach ($jabatan as $key => $val)
										<option value="{{ $key }}">{{ $val }}</option>
										@endforeach
									</select>
								</div>	
								<label for="Penempatan" class="col-sm-2 col-form-label">Penempatan</label>
								<div class="col-sm-4">
									<select class="form-control" id="penempatan" name="penempatan">
										@foreach ($penempatan as $key => $val)
										<option value="{{ $key }}">{{ $val }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card">
				<div class="card-header">
					Informasi Login
				</div>
				<div class="card-body">
					<div class="form-group row align-items-center">
						<div class="col-sm-12">
							<div class="form-group row">
								<label class="col-sm-12 col-form-label">Email</label>
								<div class="col-sm-12">
									<input type="email" class="form-control" id="email" name="email" autocomplete="off">
								</div>
								<label class="col-sm-12 col-form-label mt-1">Password</label>
								<div class="col-sm-12">
									<input type="password" class="form-control"  name="password">
								</div>
								<label class="col-sm-12 col-form-label mt-1">Konfirm Password</label>
								<div class="col-sm-12">
									<input type="password" class="form-control"  name="password_confirmation">
								</div>
								<label class="col-sm-12 col-form-label mt-1">Role</label>
								<div class="col-sm-12">
									<select class="form-control" id="role" name="role">
										@foreach ($roles as $key => $val)
										<option value="{{ $val }}">{{ $val }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mb-4">
		<button type="submit" class="btn btn-primary col-12">SUBMIT</button>
	</div>
</form>
</div>
@endsection



