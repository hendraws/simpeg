@extends('layouts.app')
@section('title', 'Jabatan ')
@section('content-title', 'Master Jabatan')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(function() {	
		// $('#table').DataTable();
	});

	$(document).on('click','.hapus',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var url = '{{ action('JabatanController@destroy',':id') }}';
		url = url.replace(':id',id);
	
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
					type:'DELETE',
					url:url,
					data:{
						"_token": "{{ csrf_token() }}",
					},
					success:function(data) {
						if (data.code == '200'){
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
	</script>
	@endsection
	@section('button-title')
	<a class="btn btn-sm btn-primary modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('JabatanController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah</a>
	@endsection
	@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						{{-- {{ __('Dashboard') }} --}}
					</div>

					<div class="card-body">
						<div class="table-responsives">
							<table class="table table-bordered" id="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Jabatan</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $value)
									<tr>
										<th scope="row">1</th>
										<td>{{ $value->jabatan }}</td>
										<td>
											<a class="btn btn-warning btn-sm modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('JabatanController@edit',$value) }}"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>
											<button class="btn btn-sm btn-danger hapus " type="button" data-id="{{ $value->id }}">hapus</button>
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
	@endsection
{{--  --}}