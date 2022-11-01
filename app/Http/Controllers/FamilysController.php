<?php

namespace App\Http\Controllers;

use App\Models\Wedding_Status;
use App\Models\Familys;
use Illuminate\Http\Request;

class FamilysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("isActive");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Familys  $familys
     * @return \Illuminate\Http\Response
     */
    public function show(Familys $familys)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Familys  $familys
     * @return \Illuminate\Http\Response
     */
    public function edit(Familys $familys)
    {
        $family = Familys::where('user_id', auth()->user()->id)->first();
        $wedding_statuses = Wedding_Status::get();

        return view('pegawai.keluarga.update', ['family' => $family, 'wedding_statuses' => $wedding_statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familys  $familys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Familys $familys)
    {

        $request->validate([
            'name' => 'min:3',
            'work' => 'min:2',
            'amount_child' => 'min:1',
        ]);

        Familys::where('user_id', auth()->user()->id)->first()->update([
            'name' => $request->name,
            'work' => $request->work,
            'amount_child' => $request->amount_child,
            'wedding_status_id' => (int)$request->wedding_status
        ]);

        return redirect()->route('familys')->with(['success' => 'Data Keluarga Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familys  $familys
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familys $familys)
    {
        //
    }
}
