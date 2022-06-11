<!DOCTYPE html>
<html>
<head>
	<title>Surat Pernyataan SIM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

{{-- 	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box; 
		}

		body{
			padding: 40px 50px;
		}

		hr {
			border: 2px solid;
		}

		.text-center{
			text-align: center !important;
		}

		.text-justify{
			text-align: justify !important;
		}

		.text-right{
			text-align: right !important;
		}


		.mt{
			margin-top: 10px;
		}

		.ml-100{
			margin-left: 100px;
		}

		.ml-50{
			margin-left: 50px;
		}
		.pl-2{
			padding-left: 50px;
		}

	</style> --}}
		<link rel="stylesheet" href="{{ public_path('/dist/css/adminlte.min.css')}}">
		<style type="text/css">
			*{
				margin: 0;
				padding:  0;
				box-sizing: border-box; 
			}
			body{
				padding: 40px 50px;
			}
		</style>
</head>
<body>
	<div class="container">
		{{-- <div id="header">
			<table align="center" width="100%">
				<tr>
					<td align="center"><img src="{{ asset('/dist/img/logo-ksp.png') }}" width="125" height="125"></td>
					<td>
						<font size="3"><b>KOPERASI SIMPAN PINJAM</b></font><br>
						<font size="4"><b>SATRIA MULIA ARTHOMORO</b></font><br>
						<font size="3"><b>PROVINSI JAWA TENGAH</b></font><br>
						<font>Badan Hukum : No. 186/BH/XIV.1/4008</font><br>
						<font>Pusat : Jl. Raya Banjarnegara – Banyumas</font><br>
						<font>Desa Danaraja RT 001 RW 002, Kec. Banyumas, Kab. Banyumas</font><br>
						<font>Email : kspsmam@gmail.com, Website : www.kspsmart.com</font><br>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
						<hr>
					</td>
				</tr>
			</table>
		</div> --}}
		<div id="body mt-5">
			<div class="text-center">
				<h3>Surat Pernyataan</h3>
			</div>
			<br>
			<p>Yang bertanda Tangan Dibawah ini : </p>
			<table style="width: 100%">
				<tr>
					<td width="40%">Nama</td>
					<td>: {{ ucwords(strtolower($data->nama)) }}</td>
				</tr>
				<tr>
					<td width="40%">Tempat Tanggal Lahir</td>
					<td>: {{ $data->tempat }}, {{ Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y'); }}</td>
				</tr>
				<tr>
					<td width="40%">Alamat</td>
					<td>: {{ $data->alamat }}</td>
				</tr>
				<tr>
					<td width="40%">Unit</td>
					<td>: {{ $data->getKantor->kantor }}</td>
				</tr>	
				<tr>
					<td width="40%">Jabatan</td>
					<td>: {{ $data->getJabatan->jabatan }}</td>
				</tr>
			</table>
			<p class="mt-4 text-justify">
				Surat pernyataan ini aktif semenjak surat ini diterbitkan dan saya tidak akan melibatkan kantor/Perusahaan manakala saya mengalami kecelakaan atau yang berkaitan dengan SIM.
			</p>
			<p class="mt-2 text-justify">
				Demikian surat pernyataan ini saya buat dengan sebenar-benarnya tanpa ada paksaan dari pihak  manapun.
			</p>
		</div>
		<div id="footer mt-5">
			<table width="40%"  >
				<tr>
					<td width="50%">Dibuat di </td>
					<td width="50%">: BANYUMAS</td>
				</tr>
				<tr>
					<td >Pada Tanggal <br><br><br><br><br></td>
					<td >:  {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('d F Y'); }}<br><br><br><br><br></td>
				</tr>
				<tr>
					<td colspan="2" class="pl-5 pt-4">&emsp; &emsp; ({{ ucwords(strtolower($data->nama)) }})</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>	