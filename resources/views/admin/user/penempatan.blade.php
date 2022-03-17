@extends('layouts.app')
@section('title', 'Penempatan Karyawan Baru')
@section('content-title', 'Penempatan Karyawan Baru')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function() {
		$('#table').DataTable({
			"aaSorting": []
		});
	});

	$(document).on('click', '.hapus', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var url = '{{ action('IndikatorPenilaianController@destroy', ':id') }}';
		url = url.replace(':id', id);

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
	}) 

</script>
@endsection
@section('button-title')
<a class="btn btn-sm btn-primary" href="{{ url()->previous() }}">Kembali</a>
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">

			<div class="card-body">
				<form action="{{ action('LamaranController@penempatanLamaran', $data->id) }}" method="POST">
					<div class="modal-body">
						@csrf
						@method('PUT')
						<div class="form-group row">
							<label for="jabatan" class="col-sm-4 col-form-label">Penempatan</label>
							<div class="col-sm-12">
								<select class="form-control" id="jabatan" name="penempatan">
									@foreach($kantor as $key => $val)
									<option value="{{ $key }}">{{ $val }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
							<div class="col-sm-12">
								<select class="form-control" id="jabatan" name="jabatan">
									@foreach($jabatan as $key => $val)
									<option value="{{ $key }}" {{ $key == $data->jabatan ? 'selected' : '' }}>{{ $val }}</option>
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
@endsection


