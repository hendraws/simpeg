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
						{{-- <td>: {{ optional($data->getUser)->is_active == 'Y' ? 'Aktif' : 'Tidak Aktif'  }}</td> --}}
						<td>: {{ $data->status_karyawan  }}</td>
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

						<td>: {{ $masaKerja }}</td>
					</tr>
					<tr>
						<td style="width:50%">SP Aktif</td>
						<td>: {{ $sp->sp ?? '-' }}</td>
					</tr>
					<tr>
						<td style="width:50%">Jenis Pelanggaran</td>
						@if(!empty($sp))
						<td>: {{ optional($sp->getJenisPelanggaran)->jenis_pelanggaran ?? '-'   }}</td>
						@else
						<td>-</td>
						@endif
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

			<div class="col-md-4">
				<table>
					<tr>
						<td style="width:50%">Surat Lamaran</td>
						<td>:
                            @if(!empty($data->surat_lamaran))
                            <a href="{{ Storage::url($data->surat_lamaran) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">Surat Pernyataan</td>
						<td>:
                            @if(!empty($data->surat_pernyataan))
                            <a href="{{ Storage::url($data->surat_pernyataan) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">Surat Pertanggung Jawaban</td>
						<td>:
                            @if(!empty($data->surat_tanggung_jawab))
                            <a href="{{ Storage::url($data->surat_tanggung_jawab) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">Ijazah Terakhir</td>
						<td>:
                            @if(!empty($data->ijazah))
                            <a href="{{ Storage::url($data->ijazah) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">CV</td>
						<td>:
                            @if(!empty($data->cv))
                            <a href="{{ Storage::url($data->cv) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">KTP</td>
						<td>:
                            @if(!empty($data->ktp))
                            <a href="{{ Storage::url($data->ktp) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">KK</td>
						<td>:
                            @if(!empty($data->kk))
                            <a href="{{ Storage::url($data->kk) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					<tr>
						<td style="width:50%">KTP Orang Tua</td>
						<td>:
                            @if(!empty($data->ktp_orangtua))
                            <a href="{{ Storage::url($data->ktp_orangtua) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					@if (!empty($data->sim))
					<tr>
						<td style="width:50%">SIM</td>
						<td>:
                            @if(!empty($data->sim))
                            <a href="{{ Storage::url($data->sim) }}">Download</a>
                            @else
                            File Belum Diupload
                            @endif
                        </td>
					</tr>
					@endif
				</table>
			</div>
			<div class="col-md-4">
				<table>
					<tr>
						<td style="width:50%">Surat Perjanjian Kerja</td>
						<td>:
                            <a href="{{ action('PegawaiController@suratPernjanjianKerja', $data->id) }}">Download</a>
                        </td>
					</tr>
					<tr>
						<td style="width:50%">Surat Pernyataan SIM</td>
						<td>:
                            <a href="{{ action('PegawaiController@suratPernyataanSim', $data->id) }}">Download</a>
                        </td>
					</tr>
					<tr>
						<td style="width:50%">Surat Penitipan Ijazah</td>
						<td>:
                            <a href="{{ action('PegawaiController@suratPenitipanIjazah', $data->id) }}">Download</a>
                        </td>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<img src="{{ Storage::url($data->foto) }}" alt="" class="img-responsive img-thumbnail"
				style="max-height: 200px">
			</div>
		</div>
	</div>

</div>
