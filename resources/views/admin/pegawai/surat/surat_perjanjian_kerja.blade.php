<?php 

function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Surat Perjanjian Kerja</title>
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
		hr {
			border: 2px solid;
		}

		.page-break {
			page-break-after: always;
		}
	</style>
</head>
<body>
	
	<div id="header">
		<table align="center" width="100%">
			<tr>
				<td align="center"><img src="{{ public_path('/dist/img/logo-ksp.png') }}" width="125" height="125"></td>
				<td>
					<font size="3"><b>KOPERASI SIMPAN PINJAM</b></font><br>
					<font size="4"><b>SATRIA MULIA ARTHOMORO</b></font><br>
					<span size="3"><b>PROVINSI JAWA TENGAH</b></span><br>
					<span><b>Badan Hukum : No. 186/BH/XIV.1/2008</b></span><br>
					<span><i>Pusat : Jl. Raya Banjarnegara – Banyumas</i></span><br>
					<span><i>Desa Danaraja RT 001 RW 002, Kec. Banyumas, Kab. Banyumas</i></span><br>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<hr>
				</td>
			</tr>
		</table>
	</div>
	<div id="body">
		<div class="text-center">
			<h5>Surat Perjanjian Kerja</h5>
			@php
			$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
			$bln = $array_bln[date('n', strtotime($data->created_at))];
			@endphp
			Nomor : {{ $data->id }}/13/SMART/SPK/{{ $bln }}/{{ date('Y', strtotime($data->created_at)) }}
		</div>
		<br>
		<p>Yang bertanda Tangan Dibawah ini : </p>
		<table style="width: 100%">
			<tr>
				<td class="text-right" width="5%">1.</td>
				<td width="40%">Nama</td>
				<td>: {{ strtoupper(optional($data->getAccUser)->name) }} </td>
				{{-- <td>: {{ ucwords(strtolower(optional($user->getProfile)->nama)) }}</td> --}}
			</tr>
			<tr>
				<td class="text-right" width="5%"></td>
				<td width="40%">Jabatan</td>
			
				<td>: {{ strtoupper(optional(optional(optional($data->getAccUser)->getProfile)->getJabatan)->jabatan) }}</td>
				{{-- <td>: {{ optional(optional($user->getProfile)->getJabatan)->jabatan }}</td> --}}
			</tr>
			<tr>
				<td class="text-right" width="5%"></td>
				<td width="40%">Alamat</td>
					<td>: {{ strtoupper(optional(optional($data->getAccUser)->getProfile)->alamat) }}</td>
				{{-- <td>: {{ optional(optional($user->getProfile)->getKantor)->kantor }}</td> --}}
			</tr>
		</table>
		<p class="mt-2 text-justify">
			Dalam hal ini bertindak atas nama  KSP Satria Mulia Arthomoro yang berkedudukan di Jl. Raya Banjarnegara – Banyumas, Danaraja  RT 001 RW 002, Kec. Banyumas, Kab. Banyumas dan selanjutnya disebut <b>PIHAK PERTAMA</b>.
		</p>
		<table style="width: 100%">
			<tr>
				<td class="text-right" width="5%">2.</td>
				<td width="40%">Nama</td>
				<td>: {{ strtoupper($data->nama) }}</td>
			</tr>
			<tr>
				<td class="text-right" width="5%"></td>
				<td width="40%">Tempat dan Tanggal Lahir</td>
				<td>: {{ strtoupper($data->tempat) }}, {{ date('d-m-Y', strtotime($data->tanggal_lahir)) }}</td>
			</tr>
			<tr>
				<td class="text-right" width="5%"></td>
				<td width="40%">Pendidikan Terakhir</td>
				<td>: {{ $data->pendidikan_terakhir }}</td>
			</tr>
			{{-- 	<tr>
					<td class="text-right" width="5%"></td>
					<td width="40%">Jenis Kelamin</td>
					<td>: {{ optional(optional($user->getProfile)->getKantor)->kantor }}</td>
				</tr> --}}
				<tr>
					<td class="text-right" width="5%"></td>
					<td width="40%">Agama</td>
					<td>: {{ $data->agama }}</td>
				</tr>
				<tr>
					<td class="text-right" width="5%"></td>
					<td width="40%">Alamat</td>
					<td>: {{ $data->alamat }}</td>
				</tr>
				<tr>
					<td class="text-right" width="5%"></td>
					<td width="40%">No KTP</td>
					<td>: {{ $data->nik }}</td>
				</tr>
				<tr>
					<td class="text-right" width="5%"></td>
					<td width="40%">Telepon</td>
					<td>: {{ $data->no_hp }}</td>
				</tr>
			</table>
			<p class="mt-2 text-justify">
				Dalam hal ini bertindak untuk dan atas nama diri pribadi dan selanjutnya disebut <b>PIHAK KEDUA</b>.
			</p>

			<p class="mt-2 text-justify">
				Pada hari ini   ({{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('l'); }}), Tanggal  ({{ date('d', strtotime($data->tanggal_diterima)) }}) ({{ penyebut(date('d', strtotime($data->tanggal_diterima))) }} ) bulan  ({{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('F'); }}) tahun  ({{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('Y'); }}) ( {{ penyebut(date('Y', strtotime($data->tanggal_diterima))) }} ), kedua belah telah bersepakat untuk mengikat diri dalam perjanjian kerja dengan syarat dan ketentuan yang diatur seperti berikut:
			</p>
			<p class="text-center font-weight-bold">
				PASAL 1
			</p>
			<p class="text-justify">
				<b>PIHAK PERTAMA</b> menyatakan menerima <b>PIHAK KEDUA</b> sebagai Calon Karyawan di KSP Satria Mulia Arthomoro yang berkedudukan di Jl. Raya Banjarnegara – Banyumas, Danaraja  RT 001 RW 002, Kec. Banyumas, Kab. Banyumas dan <b>PIHAK KEDUA</b> dengan ini menyatakan kesediaannya.
			</p>
			<div class="page-break"></div>
			<p class="text-center font-weight-bold">
				PASAL 2
			</p>
			<p class="text-justify">
				<b>PIHAK KEDUA</b> akan ditempatkan sebagai ( {{ optional($data->getJabatan)->jabatan }} ) pada ({{ optional($data->getKantor)->kantor }}) Apabila dipandang perlu dan juga dikehendaki, <b>PIHAK PERTAMA</b> dapat menempatkan <b>PIHAK KEDUA</b> dalam melaksanakan tugas dan pekerjaan lain yang oleh <b>PIHAK PERTAMA</b> dianggap lebih cocok serta sesuai dengan keahlian yang dimiliki <b>PIHAK KEDUA</b>, dengan syarat masih tetap berada di dalam lingkup kerja KSP Satria Mulia Arthomoro.
			</p>
			<p class="text-center font-weight-bold">
				PASAL 3
			</p>
			<p class="text-justify">
				Masa pelatihan dan percobaan ditetapkan selama 3 (tiga) bulan yang dihitung sejak tanggal masuk <b>PIHAK KEDUA</b> diterima sebagai calon karyawan, sebelum dinyatakan lepas training atau akan diangkat menjadi karyawan maka yang bersangkutan wajib membawa/menunjukan ijazah asli terakhir untuk disimpan di KSP Satria Mulia Arthomoro.
			</p>
			<p class="text-justify">
				Sesuai dengan peraturan ketenagakerjaan yang berlaku, jumlah jam kerja efektif adalah 7 (tujuh ) jam setiap hari dengan jumlah hari kerja  6 (enam) hari setiap minggu, dimulai hari senin dan berakhir pada hari sabtu dengan perincian sebagai berikut:
				<br>
				<ol>
					<li>
						Management atau pengaturan jam mulai kerja / jam awal kerja sepenuhnya disesuaikan kebijakan masing-masing kepala cabang.
					</li>
					<li>Maksimal jam kerja tambahan / lembur kerja adalah 14 (empat belas ) jam setiap minggunya.</li>
					<li>Management atau pengaturan waktu kerja baik di kantor ataupun di lapangan sepenuhnya menjadi tanggung jawab masing-masing karyawan dengan mengacu aturan diatas</li>
					<li>Penggunaan waktu kerja berlebih diluar dari jam kerja dan waktu lembur maksimal yang telah ditentukan oleh perusahaan menjadi tanggung jawab <b>PIHAK KEDUA</b> dan diluar tanggung jawab perusahaan atau <b>PIHAK PERTAMA</b>.</li>
					<li>Upah jam lembur diakumulasikan setiap bulannya dan disubtitusi dalam bentuk uang transport, uang makan dan sarapan setiap harinya.</li>
				</ol>
			</p>
			<p class="text-center font-weight-bold">
				PASAL 5
			</p>
			<p class="text-justify">
				<ol>
					<li><b>PIHAK PERTAMA</b> memberikan makan kepada <b>PIHAK KEDUA</b> 1 kali setiap harinya di malam hari.</li>
				</ol>
			</p>
			<p class="text-center font-weight-bold">
				PASAL 6
			</p>
			<p class="text-justify">
				<ol>
					<li>
						Setiap Karyawan berhak mengajukan dan mendapatkan cuti sesuai dengan ketentuan yang berlaku di PERSUS KSP Satria Mulia Arthomoro.
					</li>
				</ol>
			</p>
			<div class="page-break"></div>
			<p class="text-center font-weight-bold">
				PASAL 7
			</p>
			<p class="text-justify">
				<b>PIHAK PERTAMA</b> wajib membantu biaya pengobatan serta perawatan jika <b>PIHAK KEDUA</b> sakit atau memerlukan perawatan kesehatannya sesuai dengan syarat, peraturan, dan ketentuan yang telah ditetapkan oleh perusahaan.
			</p>
			<p class="text-center font-weight-bold">
				PASAL 8
			</p>
			<p class="text-justify">
				<ol>
					<li> <b>PIHAK KEDUA</b> menyatakan kesediaannya untuk mematuhi serta mentaati seluruh peraturan tata tertib KSP Satria Mulia Arthomoro yang telah ditetapkan <b>PIHAK PERTAMA</b>.</li>
					<li>
						Pelanggaran terhadap peraturan-peraturan tersebut di atas dapat mengakibatkan <b>PIHAK KEDUA</b> dijatuhi:
						<ol type="a">
							<li> Skorsing, atau</li>
							<li> Pemutusan Hubungan Pekerjaan (PHK), atau</li>
							<li> Hukuman dalam bentuk lain dengan merujuk kepada Peraturan Perusahaan dan Peraturan Pemerintah yang mengaturnya.</li>
						</ol>
					</li>
				</ol>
			</p>
			<p class="text-center font-weight-bold">
				PASAL 9
			</p>
			<p class="text-justify">
				<b>PIHAK KEDUA</b> selama masa berlakunya ikatan perjanjian kerja ini tidak dibenarkan untuk melakukan kerja rangkap di perusahaan lain manapun yang bentuk serta jenis usahanya sama atau mempunyai usaha dengan waktu kerja sama dengan KSP Satria Mulia Arthomoro, dengan alasan apapun juga, kecuali apabila <b>PIHAK KEDUA</b> telah mendapat persetujuan secara tertulis dari <b>PIHAK PERTAMA</b>.
			</p>
			<p class="text-center font-weight-bold">
				PASAL 10
			</p>
			<p class="text-justify">
				<b>PIHAK PERTAMA</b> berhak setiap saat untuk mengakhiri perjanjian kerja ini dengan syarat harus memberitahukan secara tertulis kepada <b>PIHAK KEDUA</b> sesuai dengan PERSUS yang berlaku
			</p>
			<p class="text-center font-weight-bold">
				PASAL 11
			</p>
			<p class="text-justify">
				<ol>
					<li>Apabila <b>PIHAK KEDUA</b> mengundurkan diri, atau diberhentikan status karyawannya oleh <b>PIHAK PERTAMA</b>, maka <b>PIHAK KEDUA</b> wajib melakukan serah terima tugas, pekerjaan dan tanggung jawabnya (Over Kap) kepada <b>PIHAK PERTAMA</b> atau perwakilan yang ditunjuk oleh <b>PIHAK PERTAMA</b>.</li>
					<li>Apabila <b>PIHAK KEDUA</b> ketika mengundurkan diri, atau diberhentikan status karyawannya oleh <b>PIHAK PERTAMA</b> tidak melakukan serah terima seperti yang disebutkan diatas, maka apabila terjadi selisih Minus keuangan, baik Angsuran, Nominal Pinjaman, Pinjaman yang melanggar SOP/PERSUS dan atau Pinjaman yang tidak ditemukan peminjamnya, maka semua selisih, kekurangan dan pelunasan pinjaman yang terbukti melanggar SOP akan dibebankan sepenuhnya kepada <b>PIHAK KEDUA</b>.</li>
					<li>Dalam hal Karyawan mengundurkan diri atau diberhentikan oleh <b>PIHAK PERTAMA</b>, <b>PIHAK KEDUA</b> tidak akan dan tidak dapat mengajukan tuntutan atau gugatan apapun kepada <b>PIHAK PERTAMA</b>, Serta wajib langsung mengembalikan Inventaris Kendaraan dan atau segala fasilitas yang ada selama menjadi karyawan  kepada <b>PIHAK PERTAMA</b> </li>
				</ol>			
			</p>
			<p class="text-center font-weight-bold">
				PASAL 12
			</p>
			<p class="text-justify">
				Perjanjian kerja ini akan berakhir dengan sendirinya jika <b>PIHAK KEDUA</b> meninggal dunia atau hal-hal lain yang menurut <b>PIHAK PERTAMA</b> layak diterima.
			</p>
			<p class="text-center font-weight-bold">
				PASAL 13
			</p>
			<p class="text-justify">
				Perjanjian kerja ini batal dengan jika karena keadaan atau situasi yang memaksa, seperti: bencana alam, pemberontakan, perang, huru-hara,kerusuhan, Peraturan Pemerintah atau apapun yang mengakibatkan perjanjian kerja ini tidak mungkin lagi untuk diwujudkan dengan pemberitahuan resmi dari Perusahaan (<b>PIHAK PERTAMA</b>).
			</p>
			<p class="text-center font-weight-bold">
				PASAL 14
			</p>
			<p class="text-justify">
				<ol>
					<li>Apabila terjadi perselisihan antara kedua belah pihak, akan diselesaikan secara musyawarah untuk mencapai mufakat.</li>
					<li>Apabila dengan cara ayat 1 pasal ini tidak tercapai kata sepakat, maka kedua belah pihak sepakat untuk menyelesaikan permasalahan tersebut dilakukan melalui prosedur hukum, sesuai yang berlaku di Negara Kesatuan Republik Indonesia.</li>
				</ol>
			</p>
			<p class="text-center font-weight-bold">
				PASAL 15
			</p>
			<p class="text-justify">
				Demikianlah perjanjian ini dibuat, disetujui dan ditandatangani dalam rangkap dua, asli dan tembusan bermaterai cukup dan berkekuatan hukum yang sama. Satu dipegang oleh <b>PIHAK PERTAMA</b> dan lainnya untuk <b>PIHAK KEDUA</b>.
			</p>
		</div>
		<div id="footer">
			<table width="40%"  >
				<tr>
					<td width="50%">Dibuat di </td>
					<td width="50%">: BANYUMAS</td>
				</tr>
				<tr>
					<td >Pada Tanggal <br><br><br></td>
					<td >:  {{ Carbon\Carbon::parse($data->tanggal_diterima)->translatedFormat('d F Y'); }}<br><br><br></td>
				</tr>
			</table>

			<table align="center" width="100%" class="text-center" >
				<tr>
					<td width="33%"><b>PIHAK PERTAMA</b>  <br><br><br><br><br><br></td>
					<td width="33%"></td>
					<td width="33%"><b>PIHAK KEDUA</b> <br><br><br><br><br><br></td>
				</tr>
				<tr>
					<td width="33%"><b>[{{ ucwords(strtolower(optional($data->getAccUser)->name)) }}]</b></td>
					<td width="33%"></td>
					<td width="33%"><b>	[{{ ucwords(strtolower($data->nama)) }}]</b></td>
				</tr>
			</table>
		</div>

	</body>
	</html>	