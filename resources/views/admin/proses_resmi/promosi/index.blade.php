<div class="card">
	<div class="card-header">
		<a class="btn btn-sm btn-primary" href="{{ action('PromosiController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Promosi / Demosi</a>
	</div>

	<div class="card-body">
		<div class="table-responsive" style="font-size: 13px;">
			<table class="table table-bordered display" id="table"  style="width:100%" >
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Kantor/Cabang</th>
						<th>Jabatan Awal</th>
						<th>Jabatan Baru</th>
						<th>Status</th>
						<th>Proses</th>
						<th>Draft SK</th>
						<th>SK Resmi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($dataPromosi as $data)
					<tr>
						<td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
						<td>{{ optional($data->getPegawai)->nip }}</td>
						<td>{{ optional($data->getPegawai)->nama }}</td>
						<td>{{ optional(optional($data->getPegawai)->getKantor)->kantor }}</td>
						<td>{{ optional($data->getJabatanAwal)->jabatan }}</td>
						<td>{{ optional($data->getJabatanBaru)->jabatan }}</td>
						<td>
							@if($data->status =='pending')
								<button type="button"  class="btn btn-xs btn-warning ">Belum Upload Berkas</button>
							@elseif($data->status =='sukses')
								<button type="button"  class="btn btn-xs btn-success ">Promosi disetujui</button>
							@elseif($data->status =='proses-verifikasi')
								<button type="button"  class="btn btn-xs btn-success ">Proses Verifikasi</button>
							@else
								<button type="button"  class="btn btn-xs btn-danger ">Gagal</button>
							@endif
						</td>
						<td>
                            @if(!empty($data->sk))
							@if($data->status =='proses-verifikasi')
							<a href="Javascript:void(0)" class="btn btn-xs btn-primary @if(empty($data->sk)) disable-links @endif modal-button"  data-target="ModalForm" data-url="{{ action('PromosiController@verifikasiForm', $data->id ) }}">Verifikasi Berkas</a>
							@else
							{{-- <a href="Javascript:void(0)" class="btn btn-xs btn-info">Terverifikasi</a> --}}
							<a href="Javascript:void(0)" class="btn btn-xs btn-danger modal-button">Ubah</a>
							@endif
                            @endif
						</td>
						<td><a class="btn btn-xs btn-info modal-button" href="">Download</a></td>
						<td>
                            @if(empty($data->sk))
							<a class="btn btn-xs btn-warning modal-button @if(!empty($data->sk)) disable-links @endif" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('PromosiController@uploadForm', $data->id ) }}" >Upload Berkas</a>
                            @else
							<a class="btn btn-xs btn-info" href="">Download</a>
                            @endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
