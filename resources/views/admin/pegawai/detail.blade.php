@extends('layouts.app')
@section('title', 'Detail Pegawai')
@section('content-title', 'Data ' . $data->nama)
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
        }) //tutup

        // $(document).ready(function() {
        //     $('body').toggleClass('sidebar-collapse');
        // });
    </script>
    @endsection
    @section('button-title')
    <a class="btn btn-sm btn-primary" href="{{ url()->previous() }}">Kembali</a>
    @endsection
    @section('content')
    <div class="row justify-content-center">
    	<nav>
    		<div class="nav nav-tabs" id="nav-tab" role="tablist">
    			<a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
    			<a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">History</a>
    		</div>
    	</nav>

    	<div class="col-md-12">
    		<div class="tab-content" id="nav-tabContent">
    			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    				@include('admin.pegawai.profile')
    			</div>
    			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    			@include('admin.pegawai.history')
    		</div>
    		</div>
    		
    	</div>
    </div>
    @endsection
