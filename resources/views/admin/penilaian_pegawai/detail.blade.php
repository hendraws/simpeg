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

	@media print {
		body * {
			visibility: hidden;
		}
		#data-content, #data-content * {
			visibility: visible;
		}
	
	}
</style>
@endsection
@section('js')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('js/print-this.js') }}"></script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#cetak').click(function() {
		window.print();
	}); 
</script>
@endsection
@section('button-title')	

<a href="{{ action('PenilaianPegawaiController@edit',$data->id) }}" class="btn btn-info btn-sm ">Edit Penilaian</a>
<a class="btn btn-sm btn-secondary" href="{{ url()->previous()  }}"  data-toggle="tooltip" data-placement="top" title="Kembali">Kembali</a>
<button class="btn btn-warning btn-sm" id="cetak">Cetak</button>
@endsection
@section('content')
<div id="data-content">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 text-center">
								<h5>LAPORAN HASIL</h5>
								<h5>PENILAIAN KINERJA PEGAWAI</h5>
								<h5>KSP SATRIA MULIA ARTHOMORO</h5>
							</div>
						</div>
						<hr>
						<div class="row mt-5">
							<div for="pegawai_id" class="col-sm-2 col-form-div">Pegawai</div>
							<div class="col-sm-8">
								: {{ optional($data->getPegawai)->nama }}
							</div>
						</div>
						<div class="row">
							<div for="kantor" class="col-sm-2 col-form-div">Kantor Cabang</div>
							<div class="col-sm-8">
								<div class=" col-form-div" >: {{ optional($data->getKantor)->kantor }}</div>
							</div>
						</div>
						<div class="row">
							<div for="jabatan" class="col-sm-2 col-form-div">Jabatan</div>
							<div class="col-sm-8">
								<div class=" col-form-div" >: {{ optional($data->getJabatan)->jabatan }}</div>
							</div>
						</div>
						<div class="row">
							<div for="tanggal" class="col-sm-2 col-form-div">Tanggal</div>
							<div class="col-sm-8">
								<div class=" col-form-div" >: {{ date('d/m/Y',strtotime($data->tanggal)) }}</div>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-sm">
									<thead>	
										<tr class="text-center">
											<th width="10%">No</th>
											<th width="60%">Keterangan</th>
											<th width="20%">Nilai</th>
										</tr>
									</thead>
									<tbody id="indikator">
										@foreach($data->getNilai as $key => $val)
										<tr>
											<td>{{ $loop->index + 1 }}</td>
											<td>{{ $val->getIndikator->indikator }}</td>
											<td class="text-center">{{  $val->nilai }}</td>
										</tr>
										@endforeach
										<tr class="text-center">
											<td colspan="2">Total</td>
											<td>{{ $data->getNilai->sum('nilai') }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div>Keterangan Nilai</div>
								<ul style="list-style: none;">
									<li>5 = Sangat Baik</li>
									<li>4 = Baik</li>
									<li>3 = Cukup</li>
									<li>2 = Kurang</li>
									<li>1 = Sangat Kurang</li>
								</ol>
							</div>
							<div class="col-md-6 text-center" >
								<div>Penilai</div>
								<br>
								{!! $qrcode !!}
								<br>
								<div class=" col-form-div" >{{ optional($data->getPenilai)->nama }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


