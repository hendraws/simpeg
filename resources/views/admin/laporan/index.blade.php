@extends('layouts.app')
@section('title', 'Laporan Pegawai')
@section('content-title', 'Laporan Pegawai')
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
		$('#table').DataTable({
            "aaSorting": [],
            // "order": []
        });
	});

	$(document).on('click','.hapus',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var url = '{{ action('PersusController@destroy',':id') }}';
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
	<a class="btn btn-sm btn-primary" href="{{ action('LaporanController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah</a>
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
										<th scope="col">Kantor Tugas</th>
										<th scope="col">Tanggal Mulai</th>
										<th scope="col">Tanggal Selesai</th>
										<th scope="col">Nama Kegiatan</th>
										<th scope="col">Status</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $value)
									<tr>
										<th scope="row">{{ $loop->index + 1 }}</th>
										<td>{{ optional(optional($value->getPegawai)->getKantor)->kantor }}</td>
										<td>{{ $value->tanggal_mulai }}</td>
										<td>{{ $value->tanggal_selesai }}</td>
										<td>{{ $value->nama_kegiatan }}</td>
										<td>{{ $value->status }}</td>
										<td>
											@if($value->status == 'Pending')
											<a href="Javascript:void(0)" class="btn btn-xs btn-primary modal-button"  data-target="ModalForm" data-url="{{ action('LaporanController@verifikasiForm', $value->id ) }}">Verifikasi</a>
											@endif
											<a class="btn btn-warning btn-xs" href="{{ action('LaporanController@show', $value->id) }}"  data-toggle="tooltip" data-placement="top" title="Detail" >Detail</a>
											<a class="btn btn-warning btn-xs " href="{{ action('LaporanController@edit', $value->id) }}"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>
											<button class="btn btn-xs btn-danger hapus " type="button" data-url="{{ action('LaporanController@destroy', $value->id) }}">hapus</button>
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
