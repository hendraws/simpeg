<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Promosi;
use Illuminate\Http\Request;

class ProsesResmiController extends Controller
{
    
    public function index(Request $request)
    {
    	$dataPromosi = Promosi::orderBy('updated_at', 'DESC')->get();
    	$dataMutasi = Mutasi::orderBy('updated_at', 'DESC')->get();
    	return view('admin.proses_resmi.index', compact('dataPromosi', 'dataMutasi'));
    }
}
