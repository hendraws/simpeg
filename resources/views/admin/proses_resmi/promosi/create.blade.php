@extends('layouts.app')
@section('title', 'Promosi')
@section('content-title', 'Promosi')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {

            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Pegawai",
                allowClear: true
            })

            $('#pegawai').on("select2:select", function(e) {

                var url = "{{ url()->full() }}";
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "pegawai_id": $(this).val(),
                    },
                    success: function(data) {
                        if (data.code == '200') {
                            console.log(data.pegawai);
                            $('#nip').val(data.pegawai.nip);
                            $('#nama').val(data.pegawai.nama);
                            $('#cabang').val(data.pegawai.get_kantor.kantor);
                            $('#jabatan_kini').val(data.pegawai.get_jabatan.jabatan);
                            $('#jabatan_kini_id').val(data.pegawai.jabatan);
                        }
                    }
                });
                console.log($(this).val());
            });
        });
    </script>
@endsection
@section('button-title')
    <a class="btn btn-sm btn-secondary" href="{{ action('ProsesResmiController@index') }}" data-toggle="tooltip"
        data-placement="top" title="Tambah">Kembali</a>
@endsection
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('ProsesResmiController@storePromosi') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Pegawai</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="lamaran_id" id="pegawai">
                                            <option></option>
                                            @foreach ($data as $value)
                                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="nip" value="" name="nip"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="nama" value="" name="nama"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cabang" class="col-sm-2 col-form-label">Kantor/Cabang</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="cabang" value=""
                                            name="cabang" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan_kini" class="col-sm-2 col-form-label">Jabatan Kini</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="jabatan_kini" value=""
                                            name="jabatan_kini" readonly>
                                        <input type="hidden" class="form-control" value="" name="jabatan_kini_id"
                                            id="jabatan_kini_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan_baru" class="col-sm-2 col-form-label">Jabatan Baru</label>
                                    <div class="col-sm-8">
                                        <select class="form-control " name="jabatan_baru" id="jabatan_baru">
                                            {{-- <option></option> --}}
                                            @foreach ($dataJabatan as $value)
                                                <option value="{{ $value->id }}">{{ $value->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gaji" class="col-sm-2 col-form-label">Gaji</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="gaji" value=""
                                        name="gaji">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="penerbit_sk" class="col-sm-2 col-form-label">Penerbit SK</label>
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="penerbit_sk"
                                            value="{{ auth()->user()->name }}" name="penerbit_sk" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-brand btn-square btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
