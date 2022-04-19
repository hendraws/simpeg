@extends('layouts.app')
@section('title', 'Edit Sponsor')
@section('content-title', 'Sponsor')
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
			placeholder: "Pilih Pegawai",
			allowClear: true
		})

        $('.tanggal').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });

		$('#pegawai').on("select2:select", function(e) {

			var url = "{{ url()->full() }}";
			$.ajax({
					type: 'GET',
					url: url,
					data: {
						"_token": "{{ csrf_token() }}",
						"pegawai_id": $(this).val(),
					},
					success: function(data) {
						if (data.code == '200') {
							console.log(data.pegawai);
							$('#nip').val(data.pegawai.nip);
							$('#nama').val(data.pegawai.nama);
							$('#jabatan').val(data.pegawai.get_jabatan.jabatan);
							$('#kantor_kini').val(data.pegawai.get_kantor.kantor);
							$('#kantor_kini_id').val(data.pegawai.penempatan);
						}
					}
				});

		});
	});

	$(document).on('click', '.hapus', function(e) {
		e.preventDefault();
		var url = $(this).data('url');

		Swal.fire({
			title: 'Apakah Anda Yakin ?',
			text: "Data akan terhapus tidak dapat dikembalikan lagi !",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: 'DELETE',
					url: url,
					data: {
						"_token": "{{ csrf_token() }}",
					},
					success: function(data) {
						if (data.code == '200') {
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
								);
							setTimeout(function() {
								location.reload();
							}, 2000);
						}
					}
				});

			}
		})
        }) //tutup

	$(document).ready(function() {
            // $('body').toggleClass('sidebar-collapse');
        });
    </script>
    @endsection
    @section('button-title')
    <a class="btn btn-sm btn-secondary" href="{{ action('ProsesResmiController@index') }}"  data-toggle="tooltip" data-placement="top"
    title="Tambah">Kembali</a>
    @endsection
    @section('content')
    <div class="">
    	<div class="row justify-content-center">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-body">
    					<form action="{{ action('SponsorController@update', $data->id) }}" method="POST" >
    						<div class="modal-body">
    							@csrf
    							@method('PUT')

    						<div class="form-group row">
    								<label for="nip" class="col-sm-2 col-form-label">NIP</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="nip" value="{{ optional($data->getPegawai)->nip }}" name="nip"
    									readonly>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="nama" class="col-sm-2 col-form-label">Nama</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="nama" value="{{ optional($data->getPegawai)->nama }}" name="nama"
    									readonly>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="jabatan" value="{{ optional(optional($data->getPegawai)->getJabatan)->jabatan }}" name="jabatan" readonly>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="cabang" class="col-sm-2 col-form-label">Kantor/Cabang</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="cabang" value="{{ optional($data->getKantorAwal)->kantor }}" name="cabang" readonly>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control tanggal" id="tanggal_mulai" value="{{ $data->tanggal_mulai }}" autocomplete="off" name="tanggal_mulai">
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="tanggal_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control tanggal" id="tanggal_akhir" value="{{ $data->tanggal_akhir }}" autocomplete="off" name="tanggal_akhir">
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="kantor_tugas" class="col-sm-2 col-form-label">Kantor Tugas</label>
    								<div class="col-sm-8">
    									<select class="form-control " name="kantor_tugas" id="kantor_tugas">
    										{{-- <option></option> --}}
    										@foreach($dataKantor as $value)
    										<option value="{{ $value->id }}" {{ $value->id == $data->baru ? 'selected' : '' }}>{{ $value->kantor }}</option>
    										@endforeach
    									</select>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label for="penerbit_sk" class="col-sm-2 col-form-label">Penerbit SK</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="penerbit_sk" value="{{ auth()->user()->name }}" name="penerbit_sk" readonly>
    								</div>
    							</div>

    							@if(!empty($data->dokumen))
    							<hr>
    							<div class="form-group row">
    								<label for="penerbit_sk" class="col-sm-2 col-form-label">Verifikasi Berkas</label>
    								<div class="col-sm-8">
    									<div class="form-check">
    										<input class="form-check-input" type="radio" name="status"  checked id="flexRadioDefault1" value="sukses">
    										<label class="form-check-label" for="flexRadioDefault1">
    											Sukses
    										</label>
    									</div>
    									<div class="form-check">
    										<input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"  value="gagal">
    										<label class="form-check-label" for="flexRadioDefault2">
    											Gagal
    										</label>
    									</div>
    								</div>
    							</div>
    							@endif

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


