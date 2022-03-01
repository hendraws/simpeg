@extends('layouts.app')
@section('title', 'Detail Laporan')
{{-- @section('content-title', 'Detail Laporan') --}}
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<style type="text/css">
	.white{
		background: white !important;
	}

	.radio {
		pointer-events: none;
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

</script>
@endsection
@section('button-title')	
<a class="btn btn-sm btn-warning" href="{{ action('LaporanController@edit', $data->id) }}"  data-toggle="tooltip" data-placement="top" title="Kembali">Edit</a>
<a class="btn btn-sm btn-secondary" href="{{ url()->previous()  }}"  data-toggle="tooltip" data-placement="top" title="Kembali">Kembali</a>
@endsection
@section('content')
<div class="">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Detail Laporan
				</div>
				<div class="card-body">
					<div class="form-group row m-0">
						<div class="col-sm-2 col-form-label">Nama</div>
						<div class="col-sm-10">
							: {{ optional($data->getPegawai)->nama }}
						</div>	
					</div>						
					<div class="form-group row m-0">	
						<div class="col-sm-2 col-form-label">Kantor / Cabang</div>
						<div class="col-sm-10">
							: {{ optional(optional($data->getPegawai)->getKantor)->kantor }}
						</div>
					</div>						
					<div class="form-group row m-0">
						<div class="col-sm-2 col-form-label">Jabatan</div>
						<div class="col-sm-10">
							: {{ optional(optional($data->getPegawai)->getJabatan)->jabatan }}
						</div>
					</div>						
					<div class="form-group row m-0">
						<div class="col-sm-2 col-form-label">Atasan</div>
						<div class="col-sm-10">
							: {{ optional($data->getAtasan)->nama }}
						</div>
					</div>

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Tanggal Mulai</div>
						<div class="col-sm-10">
							: {{ date('d F Y',strtotime($data->tanggal_mulai)) }}
						</div>
					</div>		
					<div class="form-group  row m-0">
						<div class="col-sm-2 col-form-label">Tanggal Selesai</div>
						<div class="col-sm-10">
							: {{ date('d F Y',strtotime($data->tanggal_selesai)) }}
						</div>
					</div>		

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Nama Kegiatan</div>
						<div class="col-sm-10">
							: {{ $data->nama_kegiatan }}
						</div>
					</div>

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Detail Kegiatan</div>
						<div class="col-sm-10">
							: {!! $data->detail_kegiatan !!}
						</div>
					</div>	

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Tujuan Kegiatan</div>
						<div class="col-sm-10">
							: {!! $data->tujuan_kegiatan !!}
						</div>
					</div>	

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Kendala / Permasalahan</div>
						<div class="col-sm-10">
							: {!! $data->kendala !!}
						</div>
					</div>	

					<div class="form-group row m-0 mt-3 ">
						<div class="col-sm-2 col-form-label">Penyelesaian Masalah</div>
						<div class="col-sm-10">
							: {!! $data->penyelesaian_masalah !!}
						</div>
					</div>	

					<div class="form-group row m-0 mt-3 justify-content-end">
						<div class="col-4 text-center">
							Penerima Laporan
						</div>
					</div>	
					<div class="form-group row m-0 mt-3 justify-content-end">
						<div class="col-4 text-center">
							{!! $qrcode !!}
						</div>
					</div>
					<div class="form-group row m-0 mt-3 justify-content-end">
						<div class="col-4 text-center">
							{{ optional($data->getAtasan)->nama }}
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


