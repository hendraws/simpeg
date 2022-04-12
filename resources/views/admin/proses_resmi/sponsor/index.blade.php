a<div class="card">
    @hasanyrole('super-admin|hrd|general-manager')
        <div class="card-header">
            <a class="btn btn-sm btn-primary" href="{{ action('SponsorController@create') }}" data-toggle="tooltip"
                data-placement="top" title="Tambah">Tambah Sponsor</a>
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
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Kantor Tugas</th>
                        <th>Ket.</th>
                        <th>Status</th>
                        @hasanyrole('super-admin|hrd|general-manager')
                            <th>Proses</th>
                        @endhasanyrole
                        <th>Draft SK</th>
                        <th>SK Resmi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSponsor as $data)
                        <tr>
                            <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                            <td>{{ optional($data->getPegawai)->nip }}</td>
                            <td>{{ optional($data->getPegawai)->nama }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->tanggal_mulai)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->tanggal_akhir)) }}</td>
                            <td>{{ optional($data->getKantorBaru)->kantor }}</td>
                            <td>
                                @if ($data->status_verifikasi == 'pending' || $data->status_verifikasi == 'verifikasi')
                                    <button type="button" class="btn btn-xs btn-warning ">Sedang diproses</button>
                                @elseif($data->status_verifikasi == 'sukses' && date('d-m-Y') >= date('d-m-Y', strtotime($data->tanggal_mulai)) && date('d-m-Y') <= date('d-m-Y', strtotime($data->tanggal_akhir)))
                                    <button type="button" class="btn btn-xs btn-success ">Aktif</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-danger ">Tidak Aktif</button>
                                @endif
                            </td>
                            <td>
                                @if ($data->status_verifikasi == 'pending')
                                    <button type="button" class="btn btn-xs btn-warning ">Belum Upload Berkas</button>
                                @elseif($data->status_verifikasi == 'sukses')
                                    <button type="button" class="btn btn-xs btn-success ">Sponsor disetujui</button>
                                @elseif($data->status_verifikasi == 'verifikasi')
                                    <button type="button" class="btn btn-xs btn-success ">Proses Verifikasi</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-danger ">Gagal</button>
                                @endif
                            </td>
                            @hasanyrole('super-admin|hrd|general-manager')
                                <td>
                                    @if (!empty($data->dokumen))
                                        {{-- @if (auth()->user()->id == $data->created_by) --}}
                                        @if ($data->status_verifikasi == 'verifikasi')
                                            <a href="Javascript:void(0)"
                                                class="btn btn-xs btn-primary @if (empty($data->dokumen)) disable-links @endif modal-button"
                                                data-target="ModalForm"
                                                data-url="{{ action('SponsorController@verifikasiForm', $data->id) }}">Verifikasi</a>
                                        @else
                                            {{-- <a href="Javascript:void(0)" class="btn btn-xs btn-info">Terverifikasi</a> --}}
                                            <a href="Javascript:void(0)" class="btn btn-xs btn-danger modal-button">Ubah</a>
                                        @endif
                                        {{-- @endif --}}
                                    @endif
                                </td>
                            @endhasanyrole
                            <td><a class="btn btn-xs btn-info"
                                    href="{{ action('SponsorController@downloadDraf', $data->id) }}">Download</a></td>
                            <td>
                                @if (empty($data->dokumen))
                                    @hasanyrole('super-admin|hrd|general-manager')
                                        <a class="btn  btn-xs btn-warning modal-button a-glow @if (!empty($data->dokumen)) disable-links @endif"
                                            href="Javascript:void(0)" data-target="ModalForm"
                                            data-url="{{ action('SponsorController@uploadForm', $data->id) }}">Upload
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
