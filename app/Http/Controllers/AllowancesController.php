<?php

namespace App\Http\Controllers;

use App\Models\Allowances;
use Illuminate\Http\Request;

class AllowancesController extends Controller
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
    public function index(Request $request)
    {
        $allowances = Allowances::where('user_id', auth()->user()->id)->latest();

        // if ($request->search) {
        //     $allowances->where([["type", "like", "%" . $request->search . "%"], []]);

        //     return view("pegawai.index", [
        //         "employees" => $employees->paginate(10)->withQueryString(),
        //     ]);
        // }

        return view('pegawai.tunjangan.index', ['allowances' => $allowances->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.tunjangan.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'min:1',
            'from' => 'min:1',
            'nominal' => 'min:4',
            'source_funds' => 'min:1',
            'start_year' => 'min:4',
            'end_year' => 'min:4',
        ]);

        Allowances::create([
            'user_id' => (int)auth()->user()->id,
            'type' => $request->type,
            'from' => $request->from,
            'nominal' => $request->nominal,
            'source_funds' => $request->source_funds,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
        ]);

        return redirect()->route('allowances')->with(['success' => "Berhasil Menambahkan Tunjangan!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function show(Allowances $allowances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allowance = Allowances::where([['id', $id], ['user_id', auth()->user()->id]])->first();

        return view('pegawai.tunjangan.update', ['allowance' => $allowance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'min:1',
            'from' => 'min:1',
            'nominal' => 'min:4',
            'source_funds' => 'min:1',
            'start_year' => 'min:4|max:4',
            'end_year' => 'min:4|max:4',
        ]);

        Allowances::where([['id', $id], ['user_id', auth()->user()->id]])
        ->first()
        ->update([
            'type' => $request->type,
            'from' => $request->from,
            'nominal' => $request->nominal,
            'source_funds' => $request->source_funds,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
        ]);

        return redirect()->route('allowances')->with(['success' => "Berhasil Memperbarui Tunjangan!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Allowances::where([['id', $id], ['user_id', auth()->user()->id]])
        ->delete();

        return redirect()->route('allowances')->with(['danger' => "Berhasil Menghapus Tunjangan!"]);
    }
}
