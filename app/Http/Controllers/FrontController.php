<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\RefOption;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {

        $jabatan = Jabatan::where('open', 'Y')->pluck('jabatan', 'id');
        $pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
        $agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
        $statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');

        return view('frontend.index',compact('jabatan', 'pendidikanAkhir', 'agama', 'statusPernikahan'));

    }

    public function cekTiket(Request $request)
    {

        $data = Lamaran::where('no_tiket', $request->no_tiket)->first();

        return view('frontend.detail', compact('data'));
    }

}
