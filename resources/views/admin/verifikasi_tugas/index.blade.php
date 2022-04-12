@extends('layouts.app')
@section('title', 'Verifikasi Tugas')
@section('content-title', 'Verifikasi Tugas')
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
			 "aaSorting": []
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

	$( document ).ready(function() {
	  $('body').toggleClass('sidebar-collapse');
	});
	</script>
	@endsection
	@section('button-title')
	<a class="btn btn-sm btn-primary modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('IndikatorPenilaianController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah</a>
	@endsection
	@section('content')
	<div class="">
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
										<th scope="col">No</th>
										<th scope="col">Tiket</th>
										<th scope="col">Tanggal</th>
										<th scope="col">Nama</th>
										{{-- <th scope="col">Kantor/Cabang</th> --}}
										<th scope="col">Interview</th>
										<th scope="col">Hasil</th>
										{{-- <th scope="col">Penempatan</th> --}}
										<th scope="col">Jabatan</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $value)
									<tr>
										<td>{{ $loop->index + 1 }}</td>
										<td>{{ $value->no_tiket }}</td>
										<td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
										<td>{{ $value->nama }}</td>
										{{-- <td></td> --}}

										<td>{{ !empty($value->tanggal_interview) ? date('d-m-Y h:i', strtotime($value->tanggal_interview)) : ''  }}</td>
										<td>{{ $value->status_lamaran }}</td>
										{{-- <td></td> --}}
										<td>{{ $value->getJabatan->jabatan }}</td>
										<td>
											<a class="btn btn-sm btn-primary"href="{{ action('LamaranController@detailPelamar', $value->id) }}">Detail</a>
                                            @if($value->status_lamaran != 'ditolak')
                                            @if($value->status_lamaran == 'menunggu-verifikasi')
											<a class="btn btn-sm btn-warning"href="{{ action('LamaranController@verifikasiLamaran', $value->id) }}">Verifikasi</a>
                                            @endif
                                            @if($value->status_lamaran == 'interview')
											<a class="btn btn-sm btn-success"href="{{ action('LamaranController@terimaLamaran', $value->id) }}">Terima</a>
											<a class="btn btn-sm btn-warning"href="{{ action('LamaranController@tolakLamaran', $value->id) }}">Tolak</a>
                                            @endif
                                            @endif
											<button class="btn btn-sm btn-danger hapus" data-url="{{ action('LamaranController@destroy', $value->id) }}">Hapus</button>
										</td>
									</tr>
									@endforeach
								{{-- 	@foreach($data as $value)
									<tr>
										<th scope="row">{{ $loop->index + 1 }}</th>
										<td>{{ $value->getJabatan->jabatan }}</td>
										<td>{{ $value->indikator }}</td>
										<td>
											<a class="btn btn-warning btn-sm modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('IndikatorPenilaianController@edit',$value) }}"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>
											<button class="btn btn-sm btn-danger hapus " type="button" data-id="{{ $value->id }}">hapus</button>
										</td>
									</tr>
									@endforeach --}}
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
