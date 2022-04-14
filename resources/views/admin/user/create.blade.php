@extends('layouts.app')
@section('title', 'Pembuatan User')
@section('content-title', 'Pembuatan User')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('js')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>

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
    <a class="btn btn-sm btn-secondary" href="{{ action('UserController@index') }}"  data-toggle="tooltip" data-placement="top"
    title="Tambah">Kembali</a>
    @endsection
    @section('content')
    <div class="">
    	<div class="row justify-content-center">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-body">
    					<form method="post" action="{{ action('UserController@store') }}" enctype='multipart/form-data'>
    						<div class="modal-body">
    							@csrf
    							<div class="form-group row">
    								<label for="jabatan" class="col-sm-2 col-form-label">Pegawai</label>
    								<div class="col-sm-8">
    									<select class="form-control select2" name="lamaran_id" id="pegawai">
    										<option></option>
    										@foreach($data as $value)
    										<option value="{{ $value->id }}" >{{ $value->nama }}</option>
    										@endforeach
    									</select>
    								</div>
    							</div>
    							<hr>
    							<div class="form-group row">
    								<label for="nip" class="col-sm-2 col-form-label">NIP</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="nip" value="" name="nip" readonly>
    								</div>
    							</div>    							
    							<div class="form-group row">
    								<label for="nama" class="col-sm-2 col-form-label">Nama</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="nama" value="" name="nama" readonly>
    								</div>
    							</div>	
    							<div class="form-group row">
    								<label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
    								<div class="col-sm-8">
    									<input required type="text" class="form-control" id="jabatan" value="" name="jabatan" readonly>
    								</div>
    							</div>
    							<div class="form-group row">
    								<label class="col-sm-2 col-form-label">Email</label>
    								<div class="col-sm-8">
    									<input type="email" class="form-control" id="email" name="email" autocomplete="off">
    								</div>
    							</div>
    							<div class="form-group row">
    								<label class="col-sm-2 col-form-label">Password</label>
    								<div class="col-sm-8">
    									<input type="password" class="form-control"  name="password">
    								</div>
    							</div>
    							<div class="form-group row">
    								<label class="col-sm-2 col-form-label">Konfirm Password</label>
    								<div class="col-sm-8">
    									<input type="password" class="form-control"  name="password_confirmation">
    								</div>
    							</div>
    							<div class="form-group row">
    								<label class="col-sm-2 col-form-label">Role</label>
    								<div class="col-sm-8">
    									<select class="form-control" id="role" name="role">
    										@foreach ($roles as $key => $val)
    										<option value="{{ $val }}">{{ $val }}</option>
    										@endforeach
    									</select>
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


