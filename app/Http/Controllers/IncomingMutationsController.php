<?php

namespace App\Http\Controllers;

use App\Models\Incoming_Mutations;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exports\IncomingMutationsExport;
use Maatwebsite\Excel\Facades\Excel;

class IncomingMutationsController extends Controller
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
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $incoming_mutations = Incoming_Mutations::latest()->paginate(10);

        return view('admin.mutasiMasuk.index', ['incoming_mutations' => $incoming_mutations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $employees = Employees::get();

        return view('admin.mutasiMasuk.store', ['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $request->validate([
            'user_id' => 'unique',
            'from' => 'min:3',
            'position' => 'min:3',
        ]);

        Incoming_Mutations::create([
            'user_id' => $request->employee,
            'from' => $request->from,
            'position' => $request->position
        ]);

        return redirect()->route('incoming-mutations')->with(['success' => 'Berhasil Menambahkan Mutasi Masuk!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incoming_Mutations  $incoming_Mutations
     * @return \Illuminate\Http\Response
     */
    public function show(Incoming_Mutations $incoming_Mutations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incoming_Mutations  $incoming_Mutations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $incoming_mutation =Incoming_Mutations::find($id);
        $employees = Employees::get();

        return view('admin.mutasiMasuk.update', ['incoming_mutation' => $incoming_mutation, 'employees' => $employees]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incoming_Mutations  $incoming_Mutations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $request->validate([
            'user_id' => 'unique',
            'from' => 'min:3',
            'position' => 'min:3',
        ]);

        $incoming_mutation =Incoming_Mutations::find($id)
        ->update([
            'user_id' => $request->employee,
            'from' => $request->from,
            'position' => $request->position
        ]);

        return redirect()->route('incoming-mutations')->with(['success' => 'Berhasil Memperbarui Mutasi Masuk!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incoming_Mutations  $incoming_Mutations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        Incoming_Mutations::destroy($id);

        return redirect()->route('incoming-mutations')->with(['danger' => 'Berhasil Menghapus Mutasi Masuk!']);
    }

    public function exportExcel() {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        return Excel::download(
            new IncomingMutationsExport(),
            "laporan_mutasi_masuk.xlsx"
        );
    }
}
