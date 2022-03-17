<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>SIMPEG KSP SMART</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css') }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.theme.default.min.css') }}" />
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container"> <a class="navbar-brand navbar-logo" href="/"> <img
                    src="{{ asset('frontend/images/logo.png') }}" alt="logo" class="logo-1"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="fas fa-bars"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form action="{{ action('FrontController@cekTiket') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan No. Tiket" name="no_tiket">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        @guest
                        <div class="input-group mb-3">
                                <a href="{{ route('login') }}" class="btn btn-primary" >LOGIN</a>
                        </div>
                        @else
                        <div class="input-group mb-3">
                            <a href="{{ route('login') }}" class="btn btn-primary" >Dashboard</a>
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Banner Image -->

    <div class="banner text-center" data-scroll-index='0'>
        <div class="banner-overlay">
            <div class="container">
                <h3 class="text-capitalize text-white">KOPERASI SIMPAN PINJAM SATRIA MULIA ARTHOMORO</h3>
                {{-- <a href="#" class="banner-btn">Get Started</a> --}}
            </div>
        </div>
    </div>

    <!-- End Banner Image -->

    <!-- About -->

    <div class="about-us section-padding" data-scroll-index='1'>
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title text-center">
                    <h3>Tentang Kami</h3>
                    {{-- <p>Suspendisse fringilla eget arcu et bibendum. Vestibulum elementum dui tempus dolor gravida, vel mattis erat fermentum.</p> --}}
                    <span class="section-title-line"></span>
                </div>
                <div class="col-md-12 mb-50">
                    <div class="section-info">
                        <div class="sub-title-paragraph text-dark">
                            <p>Koperasi Simpan Pinjam Satria Mulia Arthomoro atau lebih dikenal dengan nama KSP SMART
                                pada awal usahanya merupakan sebuah koperasi tingkat kabupaten yang bernama Koperasi
                                Simpan Pinjam Arthomoro, didirikan di kabupaten Banyumas pada tahun 2008 tanggal 09 Juni
                                2008.
                            </p>
                            <p>KSP SMART adalah Koperasi yang bergerak khusus dibidang jasa simpan pinjam, yang pada
                                saat ini telah memiliki beberapa kantor cabang di kabupaten-kabupaten lain diluar
                                Banyumas.
                            </p>
                            <p>KSP SMART selalu berkomitmen, agar menjadi Koperasi yang dapat mensejahterakan seluruh
                                Anggota dan seluruh pengelola didalamnya, mari bergabung bersama KSP SMART, untuk masa
                                depan yang lebih baik.
                            </p>

                        </div>
                        {{-- <a href="#" class="anchor-btn">Learn more <i class="fas fa-arrow-right pd-lt-10"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End About -->

    <!-- Contact -->
    <div class="contact section-padding  bg-grey" data-scroll-index='4'>
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title text-center">
                    <h3>Form Application Job KSP SATRIA MULIA ARTHOMORO</h3>
                    <span class="section-title-line"></span>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <p>SILAHKAN ISI DAN UPLOAD BERKAS YANG DIBUTUHKAN</p>
                        <p>JIKA SUDAH PERNAH MELAKUKAN INPUT DATA SILAHKAN MASUKAN NO. TIKET UNTUK MELIHAT
                            STATUS</p>

                    </div>
                    <div class="card-body ">
                        <form method="post" action="{{ action('LamaranController@store') }}"
                            enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group row align-items-center">
                                <label for="staticEmail" class="col-sm-12 col-form-label">1. Posisi
                                    Jabatan</label>
                                <div class="col-sm-10">
                                    @foreach ($jabatan as $k => $v)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jabatan"
                                                id="posisi-{{ $k }}" value="{{ $k }}">
                                            <label class="form-check-label" for="posisi-{{ $k }}">
                                                {{ $v }}
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
                                        <input class="form-check-input" type="radio" name="usia" value="< 18 Tahun">
                                        <label class="form-check-label">
                                            < 18 Tahun</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" value="18 s/d 24">
                                        <label class="form-check-label">18 s/d 24 Tahun</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" value="25 s/d 30">
                                        <label class="form-check-label">25 s/d 30 Tahun</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" value="31 s/d 35">
                                        <label class="form-check-label">31 s/d 35 Tahun</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" value="> 24">
                                        <label class="form-check-label">> 24 Tahun</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="staticEmail" class="col-sm-12 col-form-label">3. Sanggup Bekerja
                                    Dalam Tekanan</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tekanan" value="ya">
                                        <label class="form-check-label">Ya </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tekanan" value="tidak">
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
                                        <input class="form-check-input" type="radio" name="tim" value="tidak">
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="staticEmail" class="col-sm-12 col-form-label">5. Bersedia
                                    Ditempatkan Di Kantor Cabang Manapun</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tempat_cabang" value="ya">
                                        <label class="form-check-label">Ya </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tempat_cabang" value="tidak">
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="staticEmail" class="col-sm-12 col-form-label">6. Bersedia
                                    Menaati Seluruh Peraturan Yang Ada Di KSP SMART</label>
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="peraturan" value="ya">
                                        <label class="form-check-label">Ya </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="peraturan" value="tidak">
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
                                            <input type="text" class="form-control" id="tempat" name="tempat"
                                                autocomplete="off">
                                        </div>
                                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal
                                            lahir</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control datetime" id="tanggal_lahir"
                                                name="tanggal_lahir" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" name="alamat"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pendidikan_terakhir" class="col-sm-2 col-form-label">Pendidikan
                                            Terakhir</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="pendidikan_terakhir"
                                                name="pendidikan_terakhir">
                                                @foreach ($pendidikanAkhir as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="agama" name="agama">
                                                @foreach ($agama as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="status" name="status">
                                                @foreach ($statusPernikahan as $key => $val)
                                                    <option value="{{ $key }}">
                                                        {{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="no_hp" class="col-sm-2 col-form-label">No. Hp
                                            (Whatsapp)</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp">
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
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="staticEmail" class="col-sm-12 col-form-label">8. Silahkan Upload Berkas
                                    Lamaran</label>
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">a.
                                            Surat Lamaran</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="surat_lamaran">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">b.
                                            Surat Pernyataan</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="surat_pernyataan">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">c.
                                            Surat Pertanggung Jawaban Orang Tua</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="surat_tanggung_jawab">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">d. Foto
                                            Ijazah Terakhir Legalisir</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="ijazah">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">e.
                                            Daftar Riwayat Hidup / CV </label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="cv">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">f. SKCK
                                            yang masih berlaku</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="skck">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">g. Pas
                                            Foto 4x6</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="foto">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">h. Foto
                                            SIM</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="sim">
                                            <small id="passwordHelpInline" class="text-muted">
                                                * Foto SIM Wajib upload jika Petugas Dinas Luar
                                            </small>
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">i. Foto
                                            KTP Diri</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="ktp">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">j. Foto
                                            KTP Orang Tua</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="ktp_orangtua">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-3 col-form-label">k. Foto
                                            KTP KK</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control-file" name="kk">
                                        </div>
                                        <label for="kontak_dadurat" class="col-sm-12 col-form-label">*Catatan:</label>
                                        <small id="passwordHelpInline" class="text-muted ml-3">
                                            Ukuran File Maksimal 500kb
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary col-12">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact -->
    <footer class="footer-copy">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>{{ date('Y') }} &copy; Elegant. </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <!-- owl carousel js -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- magnific-popup -->
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>

    <!-- scrollIt js -->
    <script src="{{ asset('frontend/js/scrollIt.min.js') }}"></script>

    <!-- isotope.pkgd.min js -->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script>
        $(window).on("scroll", function() {

            var bodyScroll = $(window).scrollTop(),
                navbar = $(".navbar");

            if (bodyScroll > 130) {

                navbar.addClass("nav-scroll");
                //   $('.navbar-logo img').attr('src','images/logo.png');


            } else {

                navbar.removeClass("nav-scroll");
                //   $('.navbar-logo img').attr('src','images/logo.png');

            }

        });

        $(window).on("load", function() {



            var bodyScroll = $(window).scrollTop(),
                navbar = $(".navbar");

            if (bodyScroll > 130) {

                navbar.addClass("nav-scroll");
                // $('.navbar-logo img').attr('src','images/logo.png');


            } else {

                navbar.removeClass("nav-scroll");
                // $('.navbar-logo img').attr('src','images/logo.png');

            }

            /* smooth scroll
              -------------------------------------------------------*/
            $.scrollIt({

                easing: 'swing', // the easing function for animation
                scrollTime: 900, // how long (in ms) the animation takes
                activeClass: 'active', // class given to the active nav element
                onPageChange: null, // function(pageIndex) that is called when page is changed
                topOffset: -63
            });

            /* isotope
            -------------------------------------------------------*/
            var $gallery = $('.gallery').isotope({});
            $('.gallery').isotope({

                // options
                itemSelector: '.item-img',
                transitionDuration: '0.5s',

            });


            $(".gallery .single-image").fancybox({
                'transitionIn': 'elastic',
                'transitionOut': 'elastic',
                'speedIn': 600,
                'speedOut': 200,
                'overlayShow': false
            });


            /* filter items on button click
            -------------------------------------------------------*/
            $('.filtering').on('click', 'button', function() {

                var filterValue = $(this).attr('data-filter');

                $gallery.isotope({
                    filter: filterValue
                });

            });

            $('.filtering').on('click', 'button', function() {

                $(this).addClass('active').siblings().removeClass('active');

            });

        })

        $(function() {
            $(".cover-bg").each(function() {
                var attr = $(this).attr('data-image-src');

                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).css('background-image', 'url(' + attr + ')');
                }

            });

            /* sections background color from data background
            -------------------------------------------------------*/
            $("[data-background-color]").each(function() {
                $(this).css("background-color", $(this).attr("data-background-color"));
            });


            /* Owl Caroursel testimonial
              -------------------------------------------------------*/

            $('.testimonials .owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                items: 1,
                margin: 30,
                dots: true,
                nav: false,

            });

        });
    </script>
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
