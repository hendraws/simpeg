<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

Auth::routes();

Route::get('/', function () {
	return redirect(route('login'));
})->name('front');

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

	Route::get('/verifikasi-tugas', 'LamaranController@calonKaryawan');
	Route::get('/verifikasi-tugas/{id}/detail-pelamar', 'LamaranController@detailPelamar');
	Route::get('/verifikasi-tugas/{id}/verifikasi-lamaran', 'LamaranController@verifikasiLamaran');
	Route::get('/verifikasi-tugas/{id}/tolak-lamaran', 'LamaranController@tolakLamaran');
	Route::get('/verifikasi-tugas/{id}/terima-lamaran', 'LamaranController@terimaLamaran');
	Route::put('/verifikasi-tugas/{id}/interview-lamaran', 'LamaranController@interviewLamaran');
	Route::put('/verifikasi-tugas/{id}/penempatan', 'LamaranController@penempatanLamaran');
	Route::delete('/verifikasi-tugas/{id}/destroy', 'LamaranController@destroy');

	Route::get('proses-resmi', 'ProsesResmiController@index');
	Route::resource('proses-resmi/promosi', 'PromosiController');
	Route::get('proses-resmi/promosi/{id}/upload-form', 'PromosiController@uploadForm');
	Route::put('proses-resmi/promosi/{id}/upload-form-update', 'PromosiController@upload');
	Route::get('proses-resmi/promosi/{id}/verifikasi-form', 'PromosiController@verifikasiForm');
	Route::put('proses-resmi/promosi/{id}/verifikasi-form-update', 'PromosiController@verifikasi');

	Route::resource('proses-resmi/mutasi', 'MutasiController');
	Route::get('proses-resmi/mutasi/{id}/upload-form', 'MutasiController@uploadForm');
	Route::put('proses-resmi/mutasi/{id}/upload-form-update', 'MutasiController@upload');
	Route::get('proses-resmi/mutasi/{id}/verifikasi-form', 'MutasiController@verifikasiForm');
	Route::put('proses-resmi/mutasi/{id}/verifikasi-form-update', 'MutasiController@verifikasi');
	
	Route::resource('/data-pegawai', 'PegawaiController');
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

});
