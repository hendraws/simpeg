<!DOCTYPE html>
<html>
<head>
	<title>Surat Penitipan Ijazah</title>
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
		<div id="header">
			<table align="center" width="100%">
				<tr>
					<td align="center"><img src="{{ public_path('/dist/img/logo-ksp.png') }}" width="125" height="125"></td>
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
		</div>
		<div id="body mt-5">
			<div class="text-center">
				<h5>Surat Penitipan Ijazah</h5>
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
			</table>
			<p class="mt-4 text-justify">
				Pada hari ini   {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('l'); }} Tanggal  {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('d'); }} bulan  {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('F'); }} tahun  {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('Y'); }} saya menitipkan berkas berupa ijazah guna sebagai lampiran berkas lamaran dengan data sebagai berikut: 
			</p>
				<table style="width: 100%">
				<tr>
					<td width="40%">Ijazah</td>
					<td>: Ijazah</td>
				</tr>
				<tr>
					<td width="40%">Atas Nama Ijazah</td>
					<td>: {{ ucwords(strtolower($data->nama)) }}</td>
				</tr>
			</table>
			<p class="mt-2 text-justify">
				Demikian surat ini dibuat dengan keadaan sadar dan tanpa paksaan dari pihak manapun.
			</p>
		</div>
		<br>
		<br>
		<div id="footer mt-5">
			<table width="100%"  >
				<tr>
					<td width="30%">Banyumas, {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('d F Y'); }}</td>
					<td width="40%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td class="text-center">Yang Menitipkan <br><br><br><br><br><br></td>
					<td></td>
					<td class="text-center">Penerima<br><br><br><br><br><br></td>
				</tr>
				<tr>
					<td class="text-center"> ({{ ucwords(strtolower($data->nama)) }})</td>
					<td ></td>
					<td class="text-center"> ({{ ucwords(strtolower($data->nama)) }})</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>	