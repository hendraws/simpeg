<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

Auth::routes();

// Route::get('/', function () {
// 	return redirect(route('login'));
// })->name('front');

Route::get('/', 'FrontController@index');
Route::post('/cek-tiket', 'FrontController@cekTiket');
Route::get('/karir', 'LamaranController@index');
Route::get('/log', function(){
	return Activity::all()->last();
});
Route::post('/karir', 'LamaranController@store');
Route::get('/karir/{no_tiket}', 'LamaranController@show');


// dibawah ini dibutuhkan akses autitentifikasi
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['prefix'=>'/master','as'=>'master.'], function(){
		Route::resource('/jabatan', 'JabatanController');
		Route::resource('/kantor', 'KantorController');
		Route::resource('/jenis-pelanggaran', 'JenisPelanggaranController');
		Route::resource('/persus', 'PersusController');
		Route::resource('/indikator-penilaian', 'IndikatorPenilaianController');
	});

	Route::get('test-kirim-email', 'LamaranController@testEmail');
	Route::get('/verifikasi-tugas', 'LamaranController@calonKaryawan');
	Route::get('/verifikasi-tugas/{id}/detail-pelamar', 'LamaranController@detailPelamar');
	Route::get('/verifikasi-tugas/{id}/verifikasi-lamaran', 'LamaranController@verifikasiLamaran');
	Route::get('/verifikasi-tugas/{id}/tolak-lamaran', 'LamaranController@tolakLamaran');
	Route::get('/verifikasi-tugas/{id}/terima-lamaran', 'LamaranController@terimaLamaran');
	Route::put('/verifikasi-tugas/{id}/interview-lamaran', 'LamaranController@interviewLamaran');
	Route::put('/verifikasi-tugas/{id}/penempatan', 'LamaranController@penempatanLamaran');
	Route::delete('/verifikasi-tugas/{id}/destroy', 'LamaranController@destroy');

    Route::post('proses-resmi/store-promosi', 'ProsesResmiController@storePromosi');
    Route::post('proses-resmi/store-mutasi', 'ProsesResmiController@storeMutasi');

	Route::get('proses-resmi', 'ProsesResmiController@index');
	Route::resource('proses-resmi/promosi', 'PromosiController');
	Route::get('proses-resmi/promosi/{id}/upload-form', 'PromosiController@uploadForm');
	Route::put('proses-resmi/promosi/{id}/upload-form-update', 'PromosiController@upload');
	Route::get('proses-resmi/promosi/{id}/verifikasi-form', 'PromosiController@verifikasiForm');
	Route::put('proses-resmi/promosi/{id}/verifikasi-form-update', 'PromosiController@verifikasi');
	Route::get('proses-resmi/promosi/{id}/download-draf', 'PromosiController@downloadDraf');

	Route::resource('proses-resmi/mutasi', 'MutasiController');
	Route::get('proses-resmi/mutasi/{id}/upload-form', 'MutasiController@uploadForm');
	Route::put('proses-resmi/mutasi/{id}/upload-form-update', 'MutasiController@upload');
	Route::get('proses-resmi/mutasi/{id}/verifikasi-form', 'MutasiController@verifikasiForm');
	Route::put('proses-resmi/mutasi/{id}/verifikasi-form-update', 'MutasiController@verifikasi');
	Route::get('proses-resmi/mutasi/{id}/download-draf', 'MutasiController@downloadDraf');

	Route::resource('proses-resmi/sponsor', 'SponsorController');
	Route::get('proses-resmi/sponsor/{id}/upload-form', 'SponsorController@uploadForm');
	Route::put('proses-resmi/sponsor/{id}/upload-form-update', 'SponsorController@upload');
	Route::get('proses-resmi/sponsor/{id}/verifikasi-form', 'SponsorController@verifikasiForm');
	Route::put('proses-resmi/sponsor/{id}/verifikasi-form-update', 'SponsorController@verifikasi');
	Route::get('proses-resmi/sponsor/{id}/download-draf', 'SponsorController@downloadDraf');

	Route::resource('proses-resmi/surat-peringatan', 'SuratPeringatanController');
	Route::get('proses-resmi/surat-peringatan/{id}/upload-form', 'SuratPeringatanController@uploadForm');
	Route::put('proses-resmi/surat-peringatan/{id}/upload-form-update', 'SuratPeringatanController@upload');
	Route::get('proses-resmi/surat-peringatan/{id}/verifikasi-form', 'SuratPeringatanController@verifikasiForm');
	Route::put('proses-resmi/surat-peringatan/{id}/verifikasi-form-update', 'SuratPeringatanController@verifikasi');
	Route::get('proses-resmi/surat-peringatan/{id}/download-draf', 'SuratPeringatanController@downloadDraf');

	Route::resource('proses-resmi/pemberhentian', 'PemberhentianController');
	Route::get('proses-resmi/pemberhentian/{id}/upload-form', 'PemberhentianController@uploadForm');
	Route::put('proses-resmi/pemberhentian/{id}/upload-form-update', 'PemberhentianController@upload');
	Route::get('proses-resmi/pemberhentian/{id}/verifikasi-form', 'PemberhentianController@verifikasiForm');
	Route::put('proses-resmi/pemberhentian/{id}/verifikasi-form-update', 'PemberhentianController@verifikasi');
	Route::get('proses-resmi/pemberhentian/{id}/download-draf', 'PemberhentianController@downloadDraf');

	Route::resource('/data-pegawai', 'PegawaiController');
	Route::get('/data-pegawai/{id}/surat-perjanjian-kerja', 'PegawaiController@suratPernjanjianKerja');
	Route::get('/data-pegawai/{id}/surat-pernyataan-sim', 'PegawaiController@suratPernyataanSim');
	Route::get('/data-pegawai/{id}/surat-Penitipan-ijazah', 'PegawaiController@suratPenitipanIjazah');
	Route::resource('/laporan', 'LaporanController');
	Route::get('/laporan/{id}/verifikasi-form', 'LaporanController@verifikasiForm');
	Route::put('/laporan/{id}/verifikasi-form-update', 'LaporanController@verifikasi');

	Route::resource('/user', 'UserController');
	Route::resource('penilaian-pegawai', 'PenilaianPegawaiController');
	Route::get('penilaian-pegawai/{id}/daftar-pegawai', 'PenilaianPegawaiController@detailGroup');
    // command
	Route::group(['prefix'=>'/command/artisan','as'=>'account.'], function(){
		Route::get('/migrate', function(){
			Artisan::call('migrate');
			return 'Migrated';
		});

		Route::get('/clear-cache', function(){
			Artisan::call('optimize:clear');

			return 'Clear Cache';
		});
	});
	Route::view('surat','admin.proses_resmi.mutasi.surat' );
});
