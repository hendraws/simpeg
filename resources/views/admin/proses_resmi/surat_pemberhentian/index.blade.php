<div class="card">
	<div class="card-header">
		<a class="btn btn-sm btn-primary" href="{{ action('SuratPeringatanController@create') }}"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Surat Peringatan</a>
	</div>

	<div class="card-body">
		<div class="table-responsive" style="font-size: 13px;">
			<table class="table table-bordered display" id="table"  style="width:100%" >
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Kantor / Cabang</th>
						<th>Tanggal PHK</th>
						<th>Pelanggaran</th>
						<th>Aksi</th>
						<th>Status</th>
						<th>Proses</th>
						<th>Draft SK</th>
						<th>SK Resmi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($dataSuratPemberhentian as $data)
					<tr>
						<td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
						<td>{{ optional($data->getPegawai)->nip }}</td>
						<td>{{ optional($data->getPegawai)->nama }}</td>
						<td>{{ optional(optional($data->getPegawai)->getKantor)->kantor }}</td>
						<td>{{ date('d-m-Y', strtotime($data->tanggal_akhir)) }}</td>
						<td>{{ $data->sp }}</td>
						<td>
							<a href="">Hapus</a>
						</td>
						<td>
							@if($data->status =='pending')
							<button type="button"  class="btn btn-xs btn-warning ">Pending</button>
							@elseif($data->status =='sukses')
							<button type="button"  class="btn btn-xs btn-success ">Sukses</button>
							@else
							<button type="button"  class="btn btn-xs btn-danger ">Gagal</button>
							@endif
						</td>
						<td>
							@if($data->status =='pending')
							<a href="Javascript:void(0)" class="btn btn-xs btn-primary @if(empty($data->sk)) disable-links @endif modal-button"  data-target="ModalForm" data-url="{{ action('SuratPeringatanController@verifikasiForm', $data->id ) }}">Verifikasi</a>
							@else
							<a href="Javascript:void(0)" class="btn btn-xs btn-info">Terverifikasi</a>
							@endif
							<a href="Javascript:void(0)" class="btn btn-xs btn-danger modal-button">Ubah</a>
						</td>
						<td><a class="btn btn-xs btn-info modal-button" href="">Download</a></td>
						<td>
							<a class="btn btn-xs btn-warning modal-button @if(!empty($data->sk)) disable-links @endif" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('SuratPeringatanController@uploadForm', $data->id ) }}" >Upload Berkas</a>
							<a class="btn btn-xs btn-info" href="">Download</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>