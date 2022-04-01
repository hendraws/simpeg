<!DOCTYPE html>
<html>
<head>
	<title>Draft Surat Promosi</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<style type="text/css">
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
						<font>Badan Hukum : No. 186/BH/XIV.1/2008</font><br>
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
		<div id="body">
			<br>
			@php
			$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
			$bln = $array_bln[date('n', strtotime($data['created_at']))];
			@endphp
			<div class="text-center"><b><u>SURAT KEPUTUSAN</u></b></div>
			<div class="text-center">NO. {{ $data['no_surat'] }}/SMART/{{ $bln }}/{{ date('Y', strtotime($data['created_at'])) }}</div>
			<br>
			<br>
			<div>Perihal <span class="ml-100">: Perubahan Jabatan</span></div>
			<br><br>
			<div class="text-justify">Setelah melkukan beberapa evaluasi terhadap kinerja karyawan, terhitung mulai tanggal {{ Carbon\Carbon::parse($data['created_at'])->translatedFormat('d F Y'); }} Manajemen KSP Satria Mulia Arthomoro, dengan ini memutuskan :</div>
			<br><br>
			<table>
				<tr>
					<td width="250px">NIP</td>
					<td>: {{ $data['get_pegawai']['nip'] }}</td>
				</tr>
				<tr>
					<td >Nama</td>
					<td>: {{ $data['get_pegawai']['nama'] }}</td>
				</tr>
				<tr>
					<td>Jabatan Sebelumnya</td>
					<td>: {{ $data['get_jabatan_awal']['jabatan'] }}</td>
				</tr>
			</table>
			<br>
			<div class="text-justify">Secara resmi menaikan jabatannya menjadi {{ $data['get_jabatan_baru']['jabatan'] }} dengan ketentuan sebagai berikut :</div>
			<br>
			<div class="ml-50 text-justify">1. <span class="text-justify">Surat keputusan ini berlaku sejak surat ini diterbitkan dan telah disetujui.</span></div>
			<div class="ml-50 text-justify">2. <span class="text-justify">Dengan gaji sebesar Rp……………(sesuai inputan di form promosi)</span></div>
			<br>
			<div>Demikian Surat keputusan ini dibuat, bilamana pada kemudian hari ditemukan kesalahan dengan penerbitan surat keputusan ini, maka perusahaan akan melakukan penyesuaian ulang sebagaimana mestinya, Atas perhatian dan kerjasamanya kami sampaikan terima kasih.</div>
			<br>
			<br>
		</div>
		<div id="footer">
			<table align="center" width="100%" align="center" >
				<tr>
					<td width="33%"></td>
					<td width="33%"></td>
					<td width="33%">Banyumas,{{ Carbon\Carbon::parse($data['created_at'])->translatedFormat('d F Y'); }}</td>
				</tr>
				<tr>
					<td width="33%">Diterima Dan Disetujui  <br><br><br><br><br><br></td>
					<td width="33%"></td>
					<td width="33%">Mengetahui <br><br><br><br><br><br></td>
				</tr>
				<tr>
					<td width="33%"><b><u>	 {{ $data['get_pegawai']['nama'] }}</u></b></td>
					<td width="33%"></td>
					<td width="33%"><b><u>	 {{ $data['get_diajukan_oleh']['nama'] }}</u></b></td>
				</tr>
				<tr>
					<td width="33%">Penerima</td>
					<td width="33%"></td>
					<td width="33%">{{ $data['get_diajukan_oleh']['get_jabatan']['jabatan'] }}</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>