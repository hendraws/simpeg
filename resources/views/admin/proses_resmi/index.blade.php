@extends('layouts.app')
@section('title', 'Proses Resmi')
@section('content-title', 'Proses Resmi')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .disable-links {
            pointer-events: none;
        }

        .a-glow {
            animation: glowing 1500ms infinite;
        }


        @keyframes glowing {
            0% {
                /* background-color: #B20000; */
                box-shadow: 0 0 3px #000000;
            }

            50% {
                /* background-color: #FF0000; */
                box-shadow: 0 0 40px #960000;
            }

            100% {
                /* background-color: #B20000; */
                box-shadow: 0 0 3px #ff002b;
            }
        }

    </style>
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
            $('.table').DataTable({
                "aaSorting": [],
                'iDisplayLength': 50,
                dom: 'Bfrtip',
                buttons: [
                    'print', 'pdf'
                ]
            });
        });

        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            var url = $(this).data('url');

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

        $(document).ready(function() {
            $('body').toggleClass('sidebar-collapse');
        });
    </script>
@endsection
@section('button-title')

@endsection
@section('content')
    <div class="row">
        <nav class="col-md-12">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Promosi/Demosi</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Mutasi</a>
                <a class="nav-link" id="nav-sponsor-tab" data-toggle="tab" href="#nav-sponsor" role="tab"
                    aria-controls="nav-sponsor" aria-selected="false">Sponsor</a>
                <a class="nav-link" id="nav-sp-tab" data-toggle="tab" href="#nav-sp" role="tab" aria-controls="nav-sp"
                    aria-selected="false">Surat Peringatan</a>
                <a class="nav-link" id="nav-pemberhentian-tab" data-toggle="tab" href="#nav-pemberhentian" role="tab"
                    aria-controls="nav-pemberhentian" aria-selected="false">Pemberhentian</a>
            </div>
        </nav>

        <div class="col-md-12">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @include('admin.proses_resmi.promosi.index')
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @include('admin.proses_resmi.mutasi.index')
                </div>
                <div class="tab-pane fade" id="nav-sponsor" role="tabpanel" aria-labelledby="nav-sponsor-tab">
                    @include('admin.proses_resmi.sponsor.index')
                </div>
                <div class="tab-pane fade" id="nav-sp" role="tabpanel" aria-labelledby="nav-sp-tab">
                    @include('admin.proses_resmi.surat_peringatan.index')
                </div>
                <div class="tab-pane fade" id="nav-pemberhentian" role="tabpanel" aria-labelledby="nav-pemberhentian-tab">
                    @include('admin.proses_resmi.pemberhentian.index')
                </div>
            </div>

        </div>
    </div>
@endsection
