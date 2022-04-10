<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lamaran;
use App\Models\RefOption;
use App\Models\User;
use App\Models\kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = User::get();
    	
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $jabatan = Jabatan::pluck('jabatan', 'id');
        $pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
        $agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
        $statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');
        $roles = Role::pluck('name');
        $penempatan = kantor::pluck('kantor','id');
        return view('admin.user.create',compact('jabatan', 'pendidikanAkhir', 'agama', 'statusPernikahan', 'roles','penempatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::beginTransaction();
    	try {
    		$lamar = $this->validate($request, [
    			'jabatan' => 'required',
    			'nik' => 'required',
    			'nama' => 'required',
    			'tempat' => 'required',
    			'tanggal_lahir' => 'required',
    			'alamat' => 'required',
    			'pendidikan_terakhir' => 'required',
    			'agama' => 'required',
    			'status' => 'required',
    			'no_hp' => 'required',
    			'no_hp_darurat' => 'required',
    			'email' => 'required',
    			'foto' => 'max:550',
    			'password' => 'required|confirmed',
    			'penempatan' => 'required',

    		], [   'required' => 'inputan :attribute wajib diisi.' ]);


    		$no = 1;
    		do {
    			$nip = 'SMART/'.date('ymd'). $no++;
    		} while (Lamaran::where('nip', $nip)->exists());

    		if ($request->has('foto') && !empty($request->foto)) {
    			$extension = $request->file('foto')->extension();
    			$imgName = 'lamaran/' . date('dmh') . '-' .rand(1,10).'-'. Str::slug($request->nama) . '7.' . $extension;
    			$path = Storage::putFileAs('public', $request->file('foto'), $imgName);
    			$lamar['foto'] = $path;
    		}
    	

    		$lamar['status_karyawan'] = 'diterima';
    		$lamar['status_dokumen'] = 'belum-diverifikasi';
    		$lamar['status_lamaran'] = 'diterima';
    		
    		$user = User::create([
    			'name' => $request->nama,
    			'email' => $request->email,
    			'password' => Hash::make($request->password),
    		]);

    		$lamar['user_id'] = $user->id;
    		$lamar['tanggal_diterima'] = date('Y-m-d');
    		$lamar['nip'] = $nip;
    		
    		$lamar = Lamaran::create($lamar);
    		
    		$user->assignRole($request->role);


    	} catch (\ValidationException $e) {
    		DB::rollback();
    		dd($e->getErrors());
    		// dd($e->validator->messages(), $e);
    		// toastr()->error($e->getMessage()->all(), 'Error');

    		return back();
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return redirect(action('UserController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
