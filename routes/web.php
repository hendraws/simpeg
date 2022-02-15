<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

Auth::routes();

Route::get('/', function () {
	return redirect(route('login'));
})->name('front');

Route::get('/karir', 'LamaranController@index');
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
	Route::put('/verifikasi-tugas/{id}/interview-lamaran', 'LamaranController@interviewLamaran');


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
