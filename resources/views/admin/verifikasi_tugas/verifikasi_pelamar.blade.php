@extends('layouts.app')
@section('title', 'Verifikasi Pelamar')
@section('content-title', 'Verifikasi Pelamar')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<style type="text/css">

</style>
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
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

		$('.waktu').datetimepicker();

		$(document).on('click','#tolak', function(){
			if ( confirm("Apakah Anda Yakin Tolak Lamaran?") == false ) {
				return alert('false') ;
			} else {
				var url = $(this).data('url');
				return $(location).attr('href',url);
				      // alert(url) ;
				  }
				})
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
    	<div class="col-md-12">
    		<div class="card">
    			<div class="card-header">
    				{{-- {{ __('Dashboard') }} --}}
    				Detail Pelamar
    			</div>

    			<div class="card-body">
    				<div class="row">
    					<div class="col-md-6">
    						<table>
    							<table>
    								<tr>
    									<td style="width:50%">Usia > 18 Tahun</td>
    									<td>: <input type="checkbox" onclick="return false;"  value="{{ $data->surat_lamaran }}"
    										{{ $data->usia != '< 18 Tahun' ? 'checked' : '' }}></td>
    									</tr>
    									<tr>
    										<td style="width:50%">Surat Lamaran</td>
    										<td>: <input type="checkbox" onclick="return false;"  value="{{ $data->surat_lamaran }}"
    											{{ !empty($data->surat_lamaran) ? 'checked' : '' }}></td>
    										</tr>
    										<tr>
    											<td style="width:50%">Surat Pernyataan</td>
    											<td>: <input type="checkbox" onclick="return false;"  value={{ $data->surat_pernyataan }}
    												{{ !empty($data->surat_pernyataan) ? 'checked' : '' }}></td>
    											</tr>
    											<tr>
    												<td style="width:50%">Surat Pertanggung Jawaban</td>
    												<td>: <input type="checkbox" onclick="return false;"  value={{ $data->surat_tanggung_jawab }}
    													{{ !empty($data->surat_tanggung_jawab) ? 'checked' : '' }}></td>
    												</tr>
    												<tr>
    													<td style="width:50%">Ijazah Terakhir</td>
    													<td>: <input type="checkbox" onclick="return false;"  value={{ $data->ijazah }}
    														{{ !empty($data->ijazah) ? 'checked' : '' }}></td>
    													</tr>
    													<tr>
    														<td style="width:50%">CV</td>
    														<td>: <input type="checkbox" onclick="return false;"  value={{ $data->cv }} {{ !empty($data->cv) ? 'checked' : '' }}></td>
    													</tr>
    													<tr>
    														<td style="width:50%">KTP</td>
    														<td>: <input type="checkbox" onclick="return false;"  value={{ $data->ktp }} {{ !empty($data->ktp) ? 'checked' : '' }}></td>
    													</tr>
    													<tr>
    														<td style="width:50%">KK</td>
    														<td>: <input type="checkbox" onclick="return false;"  value={{ $data->kk }}
    															{{ !empty($data->kk) ? 'checked' : '' }}> </td>
    														</tr>
    														<tr>
    															<td style="width:50%">KTP Orang Tua</td>
    															<td>: <input type="checkbox" onclick="return false;"  value={{ $data->ktp_orangtua }}
    																{{ !empty($data->ktp_orangtua) ? 'checked' : '' }}></td>
    															</tr>
    															@if (!empty($data->sim))
    															<tr>
    																<td style="width:50%">SIM</td>
    																<td>: <input type="checkbox" onclick="return false;"  value={{ $data->sim }}
    																	{{ !empty($data->sim) ? 'checked' : '' }}></td>
    																</tr>
    																@endif
    															</table>
    														</table>
    													</div>
    													<div class="col-md-6 text-center">
    														<img src="{{ Storage::url($data->foto) }}" alt="" class="img-responsive img-thumbnail"
    														style="max-height: 200px">
    													</div>
    												</div>
    											</div>
    											<div class="card-footer">
    												Jadwal Interview
    											</div>
    											<div class="card-body">
    												<form method="POST" action="{{ action('LamaranController@interviewLamaran', $data->id) }}">
    													@csrf
    													@method('PUT')
    													<div class="row">
    														<div class="col-md-6">
    															<table>
    																<tr>
    																	<td style="width:50%">Tanggal & Waktu</td>
    																	<td> <input type="text" class="form-control waktu" id="tanggal_lahir" name="tanggal_interview" autocomplete="off">
    																	</td>
    																</tr>
    															</table>
    														</div>
    													</div>

    													<div class="row mt-5">
    														<div class="col-md-4">
    															<button type="submit" class="btn btn-success col-12">Verfikasi</button>
    														</div>
    													</form>
    													<div class="col-md-4">
    														<a href="javascript:void(0)" data-url="{{ action('LamaranController@tolakLamaran', $data->id) }}"
    															class="btn btn-danger col-12" id="tolak">Tolak</a>
    														</div>
    														<div class="col-md-4">
    															<a href="{{ action('LamaranController@verifikasiLamaran', $data->id) }}"
    																class="btn btn-primary col-12">Kembali</a>
    															</div>
    														</div>
    													</div>

    												</div>
    											</div>
    										</div>
    										@endsection
