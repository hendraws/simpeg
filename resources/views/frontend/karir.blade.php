<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Karir | Simpeg</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index3.html" class="navbar-brand">
                    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">KSP SMART</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Karir</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h4 class="m-0 text-dark">Form Application Job KSP SATRIA MULIA ARTHOMORO</h4>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <p>SILAHKAN ISI DAN UPLOAD BERKAS YANG DIBUTUHKAN</p>
                                    <p>JIKA SUDAH PERNAH MELAKUKAN INPUT DATA SILAHKAN MASUKAN NO. TIKET UNTUK MELIHAT
                                        STATUS</p>

                                </div>
                                <div class="card-body ">
                                    <form method="post" action="{{ action('LamaranController@store') }}" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">1. Posisi
                                                Jabatan</label>
                                            <div class="col-sm-10">
                                                @foreach ($jabatan as $k => $v)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jabatan"
                                                            id="posisi-{{ $k }}" value="{{ $k }}">
                                                        <label class="form-check-label"
                                                            for="posisi-{{ $k }}"> {{ $v }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">2. Berapa Usia
                                                Anda</label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="usia"
                                                        value="< 18 Tahun">
                                                    <label class="form-check-label">
                                                        < 18 Tahun</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="usia"
                                                        value="18 s/d 24">
                                                    <label class="form-check-label">18 s/d 24 Tahun</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="usia"
                                                        value="25 s/d 30">
                                                    <label class="form-check-label">25 s/d 30 Tahun</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="usia"
                                                        value="31 s/d 35">
                                                    <label class="form-check-label">31 s/d 35 Tahun</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="usia"
                                                        value="> 24">
                                                    <label class="form-check-label">> 24 Tahun</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">3. Sanggup Bekerja
                                                Dalam Tekanan</label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekanan"
                                                        value="ya">
                                                    <label class="form-check-label">Ya </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekanan"
                                                        value="tidak">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">4. Sanggup Bekerja
                                                Sama Dengan TIM</label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tim" value="ya">
                                                    <label class="form-check-label">Ya </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tim"
                                                        value="tidak">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">5. Bersedia
                                                Ditempatkan Di Kantor Cabang Manapun</label>
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tempat_cabang"
                                                        value="ya">
                                                    <label class="form-check-label">Ya </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tempat_cabang"
                                                        value="tidak">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">6. Bersedia
                                                Menaati Seluruh Peraturan Yang Ada Di KSP SMART</label>
                                            <div class="col-sm-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="peraturan"
                                                        value="ya">
                                                    <label class="form-check-label">Ya </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="peraturan"
                                                        value="tidak">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">7. Silahkan Isi
                                                Data Diri Anda</label>
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="nik" class="col-sm-2 col-form-label">Nik</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nik" name="nik">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nama" name="nama">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat
                                                        Lahir</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="tempat"
                                                            name="tempat">
                                                    </div>
                                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal
                                                        lahir</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control datetime" id="tanggal_lahir"
                                                            name="tanggal_lahir">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tempat_lahir"
                                                        class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="alamat" name="alamat"
                                                            rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="pendidikan_terakhir"
                                                        class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" id="pendidikan_terakhir"
                                                            name="pendidikan_terakhir">
                                                            @foreach ($pendidikanAkhir as $key => $val)
                                                                <option value="{{ $key }}">{{ $val }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="agama"
                                                        class="col-sm-2 col-form-label">Agama</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" id="agama"
                                                            name="agama">
                                                            @foreach ($agama as $key => $val)
                                                                <option value="{{ $key }}">{{ $val }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="status"
                                                        class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" id="status"
                                                            name="status">
                                                            @foreach ($statusPernikahan as $key => $val)
                                                                <option value="{{ $key }}">
                                                                    {{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="no_hp" class="col-sm-2 col-form-label">No. Hp
                                                        (Whatsapp)</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="no_hp"
                                                            name="no_hp">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="no_hp_darurat" class="col-sm-2 col-form-label">Kontak
                                                        Darurat</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="no_hp_darurat"
                                                            name="no_hp_darurat">
                                                    </div>
                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-4">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-sm-12 col-form-label">8. Silahkan Upload Berkas Lamaran</label>
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">a.
                                                        Surat Lamaran</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file" name="surat_lamaran"
                                                            >
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">b.
                                                        Surat Pernyataan</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="surat_pernyataan">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">c.
                                                        Surat Pertanggung Jawaban Orang Tua</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="surat_tanggung_jawab">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">d. Foto
                                                        Ijazah Terakhir Legalisir</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="ijazah">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">e.
                                                        Daftar Riwayat Hidup / CV </label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="cv">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">f. SKCK
                                                        yang masih berlaku</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="skck">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">g. Pas
                                                        Foto 4x6</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="foto">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">h. Foto
                                                        SIM</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="sim">
                                                            <small id="passwordHelpInline" class="text-muted">
                                                              * Foto SIM Wajib upload jika Petugas Dinas Luar
                                                            </small>
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">i. Foto
                                                        KTP Diri</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="ktp">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">j. Foto
                                                        KTP Orang Tua</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="ktp_orangtua">
                                                    </div>
                                                    <label for="kontak_dadurat" class="col-sm-3 col-form-label">k. Foto
                                                        KTP KK</label>
                                                    <div class="col-sm-3">
                                                        <input type="file" class="form-control-file"
                                                             name="kk">
                                                    </div>
                                                    <label for="kontak_dadurat"
                                                        class="col-sm-12 col-form-label">*Catatan:</label>
                                                    <small id="passwordHelpInline" class="text-muted ml-3">
                                                        Ukuran File Maksimal 500kb
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Ajukan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.datetime').datetimepicker({
                timepicker: false,
                format: 'Y/m/d',
            });
        })
    </script>
</body>

</html>
