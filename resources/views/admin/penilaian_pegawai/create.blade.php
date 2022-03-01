@extends('layouts.app')
@section('title', 'Tambah Penilaian Pegawai')
@section('content-title', 'Tambah Penilaian Pegawai')
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

		$('.select2').select2({
			theme: 'bootstrap4',
			placeholder: "",
			allowClear: true
		})

		$('.tanggal').datetimepicker({
			timepicker: false,
			format: 'Y/m/d',
		});

		$('#jabatan').on("select2:select", function(e) {

			var url = "{{ url()->full() }}";
			$.ajax({
				type: 'GET',
				url: url,
				data: {
					"_token": "{{ csrf_token() }}",
					"jabatan": $(this).val(),
				},
				success: function(data) {
					if (data.code == '200') {
						console.table(data.indikator);

						$('#indikator').empty();

						$.each( data.indikator, function( key, value ) {
							$('#indikator').append(`
								<tr>
												<td>
												`+ (key+1) +`
												</td>
												<td>
												`+ value.indikator +`
												<input type="hidden" name="indikator[`+ (value.id) +`][id]" value="`+ (value.id) +`">
												</td>
												<td>
													<div class="form-check">
														<input class="form-check-input" value="5" type="radio" name="indikator[`+ (value.id) +`][nilai]" id="sb-`+ (key+1) +`">
														<label class="form-check-label" for="sb-`+ (key+1) +`">
															SB
														</label>
													</div>
												</td>
												<td>
													<div class="form-check">
														<input class="form-check-input" value="4" type="radio" name="indikator[`+ (value.id) +`][nilai]" id="b-`+ (key+1) +`">
														<label class="form-check-label" for="b-`+ (key+1) +`">
															B
														</label>
													</div>
												</td>
												<td>
													<div class="form-check">
														<input class="form-check-input" value="3" type="radio" name="indikator[`+ (value.id) +`][nilai]" id="c-`+ (key+1) +`" checked>
														<label class="form-check-label" for="c-`+ (key+1) +`">
															C
														</label>
													</div>
												</td>
												<td>
													<div class="form-check">
														<input class="form-check-input" value="2" type="radio" name="indikator[`+ (value.id) +`][nilai]" id="k-`+ (key+1) +`">
														<label class="form-check-label" for="k-`+ (key+1) +`">
															K
														</label>
													</div>
												</td>	
												<td>
													<div class="form-check">
														<input class="form-check-input" value="1" type="radio" name="indikator[`+ (value.id) +`][nilai]" id="sk-`+ (key+1) +`">
														<label class="form-check-label" for="sk-`+ (key+1) +`">
															SK
														</label>
													</div>
												</td>
											</tr>
								`);
						});
						
					}
				}
			});
			console.log($(this).val());
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
					<form action="{{ action('PenilaianPegawaiController@store') }}" method="POST" >
						<div class="modal-body">
							@csrf
							<div class="form-group row">
								<label for="pegawai_id" class="col-sm-2 col-form-label">Pegawai</label>
								<div class="col-sm-8">
									<select class="form-control select2" name="pegawai_id" id="pegawai">
										<option></option>
										@foreach($dataPegawai as $value)
										<option value="{{ $value->id }}" >{{ $value->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="kantor" class="col-sm-2 col-form-label">Kantor Cabang</label>
								<div class="col-sm-8">
									<select class="form-control select2" name="kantor" id="kantor">
										<option></option>
										@foreach($dataKantor as $key => $value)
										<option value="{{ $key }}" >{{ $value }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
								<div class="col-sm-8">
									<select class="form-control select2" name="jabatan" id="jabatan">
										<option></option>
										@foreach($dataJabatan as $key => $value)
										<option value="{{ $key }}" >{{ $value }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control tanggal" id="tanggal" value="" autocomplete="off" name="tanggal">
								</div>
							</div>
							<div class="form-group row">
								<label for="penilaian" class="col-sm-2 col-form-label">Penilai</label>
								<div class="col-sm-8">
									<select class="form-control select2" name="penilai" id="penilaian">
										<option></option>
										@foreach($dataPegawai as $value)
										<option value="{{ $value->id }}" >{{ $value->nama }}</option>
										@endforeach
									</select>
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

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-brand btn-square btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


