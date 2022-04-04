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
						<th>SP</th>
						<th>Tanggal Selesai</th>
						<th>Kantor / Cabang</th>
						<th>Ket.</th>
						<th>Aksi</th>
						<th>Status</th>
						<th>Proses</th>
						<th>Draft SK</th>
						<th>SK Resmi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($dataSp as $data)
					<tr>
						<td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
						<td>{{ optional($data->getPegawai)->nip }}</td>
						<td>{{ optional($data->getPegawai)->nama }}</td>
						<td>{{ $data->sp }}</td>
						<td>{{ date('d-m-Y', strtotime($data->tanggal_akhir)) }}</td>
						<td>{{ optional($data->getKantorTugas)->kantor }}</td>
						<td>
							@if($data->status_verifikasi =='pending')
								<button type="button"  class="btn btn-xs btn-warning ">Belum Upload Berkas</button>
							@elseif($data->status_verifikasi =='sukses')
								<button type="button"  class="btn btn-xs btn-success ">SP disetujui</button>
							@elseif($data->status_verifikasi =='verifikasi')
								<button type="button"  class="btn btn-xs btn-success ">Proses Verifikasi</button>
							@else
								<button type="button"  class="btn btn-xs btn-danger ">Gagal</button>
							@endif
						</td>
						<td>
							<a href="">Hapus</a>
						</td>
						<td>
							@if($data->status_verifikasi =='pending' || $data->status_verifikasi =='verifikasi' )
							<button type="button"  class="btn btn-xs btn-warning ">Sedang diproses</button>
							@elseif($data->status_verifikasi =='sukses')
							<button type="button"  class="btn btn-xs btn-success ">Sukses</button>
							@else
							<button type="button"  class="btn btn-xs btn-danger ">Gagal</button>
							@endif
						</td>
						<td>
                            @if(!empty($data->dokumen))
                            @if(auth()->user()->id == $data->created_by)
							@if($data->status_verifikasi =='verifikasi')
                            <a href="Javascript:void(0)" class="btn btn-xs btn-primary @if(empty($data->dokumen)) disable-links @endif modal-button"  data-target="ModalForm" data-url="{{ action('SuratPeringatanController@verifikasiForm', $data->id ) }}">Verifikasi</a>
                            @endif
							@else
							{{-- <a href="Javascript:void(0)" class="btn btn-xs btn-info">Terverifikasi</a> --}}
							<a href="Javascript:void(0)" class="btn btn-xs btn-danger modal-button">Ubah</a>
							@endif
                            @endif

						</td>
						<td><a class="btn btn-xs btn-info" href="{{ action('SuratPeringatanController@downloadDraf', $data->id) }}">Download</a></td>
						<td>
                            @if(empty($data->dokumen))
                            @if(optional(optional(auth()->user())->getProfile)->id == $data->lamaran_id)
							<a class="btn btn-xs btn-warning modal-button a-glow @if(!empty($data->dokumen)) disable-links @endif" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('SuratPeringatanController@uploadForm', $data->id ) }}" >Upload Berkas</a>
							@endif
                            @else
							<a class="btn btn-xs btn-info" href="{{ Storage::url($data->dokumen) }}" target="_blank">Download</a>
                            @endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
