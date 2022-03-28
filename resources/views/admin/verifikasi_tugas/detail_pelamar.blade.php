@extends('layouts.app')
@section('title', 'Detail Pelamar')
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
                                    <td style="width:50%">Usia</td>
                                    <td>: {{ $data->usia }}</td>
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
                        <div class="col-md-6 text-center">
                            <img src="{{ Storage::url($data->foto) }}" alt="" class="img-responsive img-thumbnail"
                                style="max-height: 200px">
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
                    </div>
                    @if($data->status_lamaran == 'menunggu-verifikasi')
                    <div class="row mt-5">
                        <a href="{{ action('LamaranController@verifikasiLamaran', $data->id) }}" class="btn btn-warning col-md-12">Verfikasi Lamaran</a>
                    </div>
                    @endif

                    @if($data->status_lamaran == 'interview')
					 <div class="row mt-5 text-center">
                        <a href="{{ action('LamaranController@terimaLamaran', $data->id) }}" class="btn btn-success col-md-5 m-1">Terima</a>
                        <a href="{{ action('LamaranController@tolakLamaran', $data->id) }}" class="btn btn-danger col-md-5 m-1">Tolak</a>
`	                 </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
