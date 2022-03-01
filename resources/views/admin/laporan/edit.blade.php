@extends('layouts.app')
@section('title', 'Laporan')
@section('content-title', 'Laporan')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<style type="text/css">
	.white{
		background: white !important;
	}
</style>
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

		$('.select2').select2({
			theme: 'bootstrap4',
			placeholder: "",
			allowClear: true
		})

		$('.tanggal').datetimepicker({
			timepicker: false,
			format: 'Y/m/d',
		});

	});
</script>
@endsection
@section('button-title')
<a class="btn btn-sm btn-secondary" href="{{ action('PenilaianPegawaiController@index') }}"  data-toggle="tooltip" data-placement="top"
title="Tambah">Kembali</a>
@endsection
@section('content')
<div class="">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ action('LaporanController@store') }}" method="POST" >
						<div class="modal-body">
							@csrf
							<div class="form-group row">
								<label for="nama" class="col-sm-2 col-form-label">Nama</label>
								<div class="col-sm-8">
									<input readonly type="text" class="form-control white" id="nama"  autocomplete="off" name="nama" value="{{ $data->nama }}">
								</div>
							</div>							
							<div class="form-group row">
								<label for="kantor" class="col-sm-2 col-form-label">Kantor</label>
								<div class="col-sm-8">
									<input readonly type="text" class="form-control white" id="kantor"  autocomplete="off" name="kantor" value="{{ optional($data->getKantor)->kantor }}">
								</div>
							</div>							
							<div class="form-group row">
								<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
								<div class="col-sm-8">
									<input readonly type="text" class="form-control white" id="jabatan"  autocomplete="off" name="jabatan" value="{{ optional($data->getJabatan)->jabatan }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="atasan" class="col-sm-2 col-form-label">Atasan</label>
								<div class="col-sm-8">
									<select class="form-control select2" name="atasan" id="atasan">
										<option></option>
										@foreach($dataPegawai as $value)
										<option value="{{ $value->id }}" >{{ $value->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tanggal" id="tanggal_mulai" value="" autocomplete="off" name="tanggal_mulai">
								</div>
							</div>		
							<div class="form-group row">
								<label for="tanggal_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tanggal" id="tanggal_selesai" value="" autocomplete="off" name="tanggal_selesai">
								</div>
							</div>			
							<div class="form-group row">
								<label for="nama_kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
								<div class="col-sm-8">
									<input type="text" class="form-control " id="nama_kegiatan"  autocomplete="off" name="nama_kegiatan">
								</div>
							</div>		
							<div class="form-group row">
								<label for="detail_kegiatan" class="col-sm-2 col-form-label">Detail Kegiatan</label>
								<div class="col-sm-8">
									 <textarea class="form-control" id="detail_kegiatan" name="detail_kegiatan" rows="3"></textarea>
								</div>
							</div>	
							<div class="form-group row">
								<label for="tujuan" class="col-sm-2 col-form-label">Tujuan Kegiatan</label>
								<div class="col-sm-8">
								 <textarea class="form-control" id="tujuan" name="tujuan_kegiatan" rows="3"></textarea>
								</div>
							</div>		
							<div class="form-group row">
								<label for="kendala" class="col-sm-2 col-form-label">Kendala / Permasalahan</label>
								<div class="col-sm-8">
									 <textarea class="form-control" id="kendala" name="kendala" rows="3"></textarea>
								</div>
							</div>		
							<div class="form-group row">
								<label for="penyelesaian_masalah" class="col-sm-2 col-form-label">Penyelesaian Masalah</label>
								<div class="col-sm-8">
								 <textarea class="form-control" id="penyelesaian_masalah" name="penyelesaian_masalah" rows="3"></textarea>
								</div>
							</div>		
						</div>
						<div class="modal-footer">
							<button class="btn btn-brand btn-square btn-primary">Simpan</button>
							<a href="{{ url()->previous() }}" class="btn btn-brand btn-square btn-secondary">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection