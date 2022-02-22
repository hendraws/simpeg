<div class="card">
	<div class="card-header">
		{{-- {{ __('Dashboard') }} --}}
		Detail karyawan
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width:50%">Status</td>
						<td>: {{ optional($data->getUser)->is_active == 'Y' ? 'Aktif' : 'Tidak Aktif'  }}</td>
					</tr>  
					<tr>
						<td style="width:50%">NIP</td>
						<td>: {{ $data->nip }}</td>
					</tr>
					<tr>
						<td style="width:50%">Nama</td>
						<td>: {{ $data->nama }}</td>
					</tr>
					<tr>
						<td style="width:50%">NIK</td>
						<td>: {{ $data->nik }}</td>
					</tr>
					<tr>
						<td style="width:50%">Tempat, Tanggal Lahir</td>
						<td>: {{ $data->tempat }}, {{ date('d/m/Y', strtotime($data->tanggal_lahir)) }}</td>
					</tr>
					<tr>
						<td style="width:50%">Alamat</td>
						<td>: {{ $data->alamat }}</td>
					</tr>
					<tr>
						<td style="width:50%">Pendidikan</td>
						<td>: {{ $data->pendidikan_terakhir }}</td>
					</tr>
					<tr>
						<td style="width:50%">No. Hp</td>
						<td>: {{ $data->no_hp }}</td>
					</tr>
					<tr>
						<td style="width:50%">Email</td>
						<td>: {{ $data->email }}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">

				<table>
					<tr>
						<td styl-e="width:50%">Jabatan</td>
						<td>: {{ optional($data->getJabatan)->jabatan }}</td>
					</tr>
					<tr>
						<td style="width:50%">Kantor/Cabang</td>
						<td>: {{ optional($data->getKantor)->kantor }}</td>
					</tr>
					<tr>
						<td style="width:50%">Tanggal Diterima</td>
						<td>: {{ $data->tanggal_diterima }}</td>
					</tr>
					<tr>
						<td style="width:50%">Masa Kerja</td>
						<td>: {{ $data->masa_kerja }}</td>
					</tr>
					<tr>
						<td style="width:50%">SP Aktif</td>
						<td>: --</td>
					</tr>
					<tr>
						<td style="width:50%">Jenis Pelanggaran</td>
						<td>: --</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="card-footer">
		Lampiran Berkas
	</div>
	<div class="card-body">
		<div class="row">

			<div class="col-md-6">
				<table>
					<tr>
						<td style="width:50%">Surat Lamaran</td>
						<td>: <a href="{{ Storage::url($data->surat_lamaran) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">Surat Pernyataan</td>
						<td>: <a href="{{ Storage::url($data->surat_pernyataan) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">Surat Pertanggung Jawaban</td>
						<td>: <a href="{{ Storage::url($data->surat_tanggung_jawab) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">Ijazah Terakhir</td>
						<td>: <a href="{{ Storage::url($data->ijazah) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">CV</td>
						<td>: <a href="{{ Storage::url($data->cv) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">KTP</td>
						<td>: <a href="{{ Storage::url($data->ktp) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">KK</td>
						<td>: <a href="{{ Storage::url($data->kk) }}">Download</a></td>
					</tr>
					<tr>
						<td style="width:50%">KTP Orang Tua</td>
						<td>: <a href="{{ Storage::url($data->ktp_orangtua) }}">Download</a></td>
					</tr>
					@if (!empty($data->sim))
					<tr>
						<td style="width:50%">SIM</td>
						<td>: <a href="{{ Storage::url($data->sim) }}">Download</a></td>
					</tr>
					@endif
				</table>
			</div>
			<div class="col-md-6">
				<img src="{{ Storage::url($data->foto) }}" alt="" class="img-responsive img-thumbnail"
				style="max-height: 200px">
			</div>
		</div>
	</div>

</div>