@extends('layouts.app')
@section('title', 'Penilaian Pegawai')
@section('content-title', 'Penilaian Pegawai')
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
	<a class="btn btn-sm btn-primary" href="{{ action('PenilaianPegawaiController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah</a>
	@endsection
	@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Kantor : {{ $kantor->kantor }}
					</div>

					<div class="card-body">
						<div class="table-responsives">
							<table class="table table-bordered" id="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama</th>
										<th scope="col">Jabatan</th>
										<th scope="col">Tanggal Penilaian </th>
										<th scope="col">Penilai </th>
										<th scope="col">Nilai </th>
										<th scope="col">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $value)
									<tr>
										<th scope="row">{{ $loop->index + 1 }}</th>
										<td>{{ optional($value->getPegawai)->nama }}</td>
										<td>{{ optional($value->getJabatan)->jabatan }}</td>
										<td>{{ date('d/m/Y', strtotime($value->tanggal)) }}</td>
										<td>{{ optional($value->getPenilai)->nama }}</td>
										<td>{{ optional($value->getNilai)->sum('nilai') }}</td>
										<td>
											<a class="btn btn-info btn-xs" href="{{ action('PenilaianPegawaiController@show',$value->id) }}"  data-toggle="tooltip" data-placement="top" title="detail" >Detail</a>
											<a class="btn btn-warning btn-xs" href="{{ action('PenilaianPegawaiController@edit',$value->id) }}"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>
											<button class="btn btn-xs btn-danger hapus " type="button" data-url="{{ action('PenilaianPegawaiController@destroy',$value->id) }}">hapus</button>
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
