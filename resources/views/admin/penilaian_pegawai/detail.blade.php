@extends('layouts.app')
@section('title', 'Detail Penilaian Pegawai')
@section('content-title', 'Detail Penilaian Pegawai')
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
<a class="btn btn-sm btn-secondary" href="{{ url()->previous()  }}"  data-toggle="tooltip" data-placement="top"
title="Kembali">Kembali</a>
@endsection
@section('content')
<div class="">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="modal-body">
						@csrf
						<div class="form-group row">
							<label for="pegawai_id" class="col-sm-2 col-form-label">Pegawai</label>
							<div class="col-sm-8">
								<input type="text" readonly class="form-control white" value="{{ optional($data->getPegawai)->nama }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="kantor" class="col-sm-2 col-form-label">Kantor Cabang</label>
							<div class="col-sm-8">
								<input type="text" readonly class="form-control white" value="{{ optional($data->getKantor)->kantor }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
							<div class="col-sm-8">
								<input type="text" readonly class="form-control white" value="{{ optional($data->getJabatan)->jabatan }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
							<div class="col-sm-8">
								<input type="text" readonly class="form-control white" value="{{ date('d/m/Y',strtotime($data->tanggal)) }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="penilaian" class="col-sm-2 col-form-label">Penilai</label>
							<div class="col-sm-8">
								<input type="text" readonly class="form-control white" value="{{ optional($data->getPenilai)->nama }}">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<table class="table">
									<thead>	
										<tr class="text-center">
											<th width="10%">No</th>
											<th width="60%">Keterangan</th>
											<th colspan="5" width="30%">Nilai</th>
										</tr>
									</thead>
									<tbody id="indikator">
										@foreach($data->getNilai as $key => $val)
										<tr>
											<td>{{ $loop->index + 1 }}</td>
											<td>{{ $val->getIndikator->indikator }}</td>
											<td>
												<div class="form-check">
													<input class="form-check-input radio" value="5" type="radio"  {{ $val->nilai == '5' ? 'checked' : '' }} >
													<label class="form-check-label" >
														SB
													</label>
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input radio" value="4" type="radio"  {{ $val->nilai == '4' ? 'checked' : '' }} >
													<label class="form-check-label" >
														B
													</label>
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input radio" value="3" type="radio" {{ $val->nilai == '3' ? 'checked' : '' }}>
													<label class="form-check-label" >
														C
													</label>
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input radio" value="2" type="radio" {{ $val->nilai == '2' ? 'checked' : '' }} >
													<label class="form-check-label">
														K
													</label>
												</div>
											</td>	
											<td>
												<div class="form-check">
													<input class="form-check-input radio" value="1" type="radio" {{ $val->nilai == '1' ? 'checked' : '' }} >
													<label class="form-check-label">
														SK
													</label>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


