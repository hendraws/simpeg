<!DOCTYPE html>
<html>
<head>
	<title>Draft Surat Sponsor</title>
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
			$bln = $array_bln[date('n')];
			@endphp
			<div class="text-center"><b><u>SURAT KEPUTUSAN</u></b></div>
			<div class="text-center">NO. {{ $data['id'] }}/SMART/{{ $bln }}/{{ date('Y', strtotime($data['created_at'])) }}</div>
			<br>
			<br>
			<div>Perihal <span class="ml-100">: Sponsor Karyawan</span></div>
			<br><br>
			<div class="text-justify">Berdasarkan Evaluasi perusahaan terhadap Perkembangan Kantor {{ $data['get_kantor_tugas']['kantor'] }} , maka Manajemen KSP Satria Mulia Arthomoro, dengan ini memutuskan :</div>
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
					<td>Kantor Cabang Sponsor</td>
					<td>: {{ $data['get_pegawai']['get_kantor']['kantor'] }}</td>
				</tr>
			</table>
			<br>
			<div class="text-justify">Secara resmi menugaskan yang bersangkutan di kantor {{ $data['get_kantor_tugas']['kantor'] }}  dengan ketentuan sebagai berikut :</div>
			<br>
			<div class="ml-50 text-justify">1. <span class="text-justify">Surat keputusan ini berlaku sejak surat ini diterbitkan dan telah disetujui.</span></div>
			<div class="ml-50 text-justify">2. <span class="text-justify">Tanggal Aktif mulai tugas Sponsor adalah dari {{ Carbon\Carbon::parse($data['tanggal_mulai'])->translatedFormat('d F Y'); }} sampai dengan {{ Carbon\Carbon::parse($data['tanggal_akhir'])->translatedFormat('d F Y'); }}.</span></div>
			<div class="ml-50 text-justify">3. <span class="text-justify">Apabila ada perubahan masa waktu sponsor akan diberitahukan dan dibuatkan SK lebih lanjut.</span></div>
			<div class="ml-50 text-justify">4. <span class="text-justify">Yang bersangkutan berhak mendapatkan insentif Sponsor dengan nominal sesuai yang ditentukan.</span></div>
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
					<td width="33%">Banyumas, {{ Carbon\Carbon::parse($data['created_at'])->translatedFormat('d F Y'); }}</td>
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