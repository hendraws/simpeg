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
    public function create(Request $request)
    {
        
        // $jabatan = Jabatan::pluck('jabatan', 'id');
        // $pendidikanAkhir = RefOption::where('modul', 'jenjang_pendidikan')->pluck('option', 'key');
        // $agama = RefOption::where('modul', 'agama')->pluck('option', 'key');
        // $statusPernikahan = RefOption::where('modul', 'status_pernikahan')->pluck('option', 'key');
        // $penempatan = kantor::pluck('kantor','id');

        if($request->ajax()){
    		$result['code'] = '200';
    		$result['pegawai'] = Lamaran::find($request->pegawai_id);
    		return response()->json($result);
    	}

    	$data = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->whereNull('user_id')->get();
        $roles = Role::pluck('name');

        return view('admin.user.create',compact('data','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// dd($request->all());

        DB::beginTransaction();
    	try {
    		$lamar = $this->validate($request, [
    			'email' => 'required',
    			'password' => 'required|confirmed',
    			'role' => 'required',
    		], [   'required' => 'inputan :attribute wajib diisi.' ]);
    		
    		$dataProfile = Lamaran::find($request->lamaran_id);

    		$user = User::create([
    			'name' => $request->nama,
    			'email' => $request->email,
    			'password' => Hash::make($request->password),
    		]);

    		$dataProfile->update([
    			'user_id' => $user->id
    		]);
    		
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
    public function edit(Request $request, $id)
    {
    
        if($request->ajax()){
    		$result['code'] = '200';
    		$result['pegawai'] = Lamaran::find($request->pegawai_id);
    		return response()->json($result);
    	}

        $data = User::find($id);
    	$pegawai = Lamaran::where('status_lamaran','diterima')->whereNotNull('nip')->whereNull('user_id')->orWhere('id', optional($data->getProfile)->id)->get();
    	// dd($pegawai, $data->getProfile);
        $roles = Role::pluck('name');
        return view('admin.user.edit',compact('pegawai','roles', 'data'));

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


        DB::beginTransaction();
    	try {
    		$lamar = $this->validate($request, [
    			'email' => 'required',
    			'password' => 'nullable|confirmed',
    			'role' => 'required',
    		], [   'required' => 'inputan :attribute wajib diisi.' ]);
    		

    		$user = User::find($id);

    		if(!empty($request->password)){
	    		$input['password'] = Hash::make($request->password);
    		}
    		$input['email'] = $request->email;

    		$user->update($input);
    		$user->syncRoles([$request->role]);


    	} catch (\ValidationException $e) {
    		DB::rollback();
    		dd($e->getErrors());
    		// dd($e->validator->messages(), $e);
    		// toastr()->error($e->getMessage()->all(), 'Error');

    		return back();
    	}
        // dd($request);
    	DB::commit();
    	toastr()->success('Data telah diubah', 'Berhasil');
    	return redirect(action('UserController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$user = User::find($id); 

    	$user->getProfile()->update([
    		'user_id' => null
    	]);
    	
    	$user->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
