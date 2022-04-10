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
	<div class="container">
		@if($errors->any())
		
		{!! implode('', $errors->all('
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>:message</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>

			')) !!}

			@endif
		</div>
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
