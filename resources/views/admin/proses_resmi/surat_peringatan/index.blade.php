<div class="card">
    @hasanyrole('super-admin|hrd|general-manager|koordinator-dan-spv')
        <div class="card-header">
            <a class="btn btn-sm btn-primary" href="{{ action('SuratPeringatanController@create') }}" data-toggle="tooltip"
                data-placement="top" title="Tambah">Tambah Surat Peringatan</a>
        </div>
    @endhasanyrole

    <div class="card-body">
        <div class="table-responsive" style="font-size: 13px;">
            <table class="table table-bordered display" id="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>SP</th>
                        <th>Tanggal Selesai</th>
                        {{-- <th>Kantor / Cabang</th> --}}
                        <th>Ket.</th>
                        <th>Aksi</th>
                        <th>Status</th>
                        @hasanyrole('super-admin|hrd|general-manager|koordinator-dan-spv')
                            <th>Proses</th>
                        @endhasanyrole
                        <th>Draft SK</th>
                        <th>SK Resmi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSp as $data)
                        <tr>
                            <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                            <td>{{ optional($data->getPegawai)->nip }}</td>
                            <td>{{ optional($data->getPegawai)->nama }}</td>
                            <td>{{ $data->sp }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->tanggal_akhir)) }}</td>
                            {{-- <td>{{ optional($data->getKantorTugas)->kantor }}</td> --}}
                            <td>
                                @if ($data->status_verifikasi == 'pending')
                                    <button type="button" class="btn btn-xs btn-warning ">Belum Upload Berkas</button>
                                @elseif($data->status_verifikasi == 'sukses')
                                    <button type="button" class="btn btn-xs btn-success ">SP disetujui</button>
                                @elseif($data->status_verifikasi == 'verifikasi')
                                    <button type="button" class="btn btn-xs btn-success ">Proses Verifikasi</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-danger ">Gagal</button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger hapus" data-url="{{ action('SuratPeringatanController@destroy', $data->id) }}">Hapus</button>
                            </td>
                            <td>
                                @if ($data->status_verifikasi == 'pending' || $data->status_verifikasi == 'verifikasi')
                                    <button type="button" class="btn btn-xs btn-warning ">Sedang diproses</button>
                                @elseif($data->status_verifikasi == 'sukses')
                                    <button type="button" class="btn btn-xs btn-success ">Sukses</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-danger ">Gagal</button>
                                @endif
                            </td>
                            @hasanyrole('super-admin|hrd|general-manager|koordinator-dan-spv')
                                <td>
                                    @if (!empty($data->dokumen))
                                        {{-- @if (auth()->user()->id == $data->created_by) --}}
                                        @if ($data->status_verifikasi == 'verifikasi')
                                            <a href="Javascript:void(0)"
                                                class="btn btn-xs btn-primary @if (empty($data->dokumen)) disable-links @endif modal-button"
                                                data-target="ModalForm"
                                                data-url="{{ action('SuratPeringatanController@verifikasiForm', $data->id) }}">Verifikasi</a>
                                        
                                        @endif
                                    @endif
                                            <a href="{{ action('SuratPeringatanController@edit', $data->id) }}" class="btn btn-xs btn-warning">Ubah</a>

                                </td>
                            @endhasanyrole
                            <td><a class="btn btn-xs btn-info"
                                    href="{{ action('SuratPeringatanController@downloadDraf', $data->id) }}">Download</a>
                            </td>
                            <td>
                                @if (empty($data->dokumen))
                                    @hasanyrole('super-admin|hrd|general-manager')
                                        <a class="btn btn-xs btn-warning modal-button a-glow @if (!empty($data->dokumen)) disable-links @endif"
                                            href="Javascript:void(0)" data-target="ModalForm"
                                            data-url="{{ action('SuratPeringatanController@uploadForm', $data->id) }}">Upload
                                            Berkas</a>
                                    @endhasanyrole
                                @else
                                    <a class="btn btn-xs btn-info" href="{{ Storage::url($data->dokumen) }}"
                                        target="_blank">Download</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
