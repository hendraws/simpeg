<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lamaran;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$jabatan = Jabatan::where('open','Y')->pluck('jabatan','id');
        return view('frontend.karir', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function show(Lamaran $lamaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lamaran $lamaran)
    {
        //
    }
}
