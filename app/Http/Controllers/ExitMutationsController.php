<?php

namespace App\Http\Controllers;

use App\Models\Exit_Mutations;
use App\Models\Incoming_Mutations;
use App\Models\User;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exports\ExitMutationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExitMutationsController extends Controller
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

        $exit_mutations = Exit_Mutations::latest()->paginate(10);

        return view('admin.mutasiKeluar.index', ['exit_mutations' => $exit_mutations]);
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

        return view('admin.mutasiKeluar.store', ['employees' => $employees]);
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
            'purpose_moving' => 'min:5',
            'position' => 'min:4'
        ]);
        
        Exit_Mutations::create([
            'user_id' => $request->employee,
            'purpose_moving' => $request->purpose_moving,
            'position' => $request->position
        ]);

        Incoming_Mutations::where('user_id', $request->employee)->delete();

        User::find($request->employee)->update(
            [
                'is_active' => false
            ]
            );

        return redirect()->route('exit-mutations')->with(['success' => 'Berhasil Menambahkan Mutasi Keluar!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exit_Mutations  $exit_Mutations
     * @return \Illuminate\Http\Response
     */
    public function show(Exit_Mutations $exit_Mutations)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exit_Mutations  $exit_Mutations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $exit_mutation = Exit_Mutations::find($id);
        $employees = Employees::get();

        return view('admin.mutasiKeluar.update', ['exit_mutation' => $exit_mutation, 'employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exit_Mutations  $exit_Mutations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exit_Mutations $exit_Mutations)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $request->validate([
            'user_id' => 'unique',
            'purpose_moving' => 'min:5',
            'position' => 'min:4'
        ]);

        Exit_Mutations::find($id)
        ->update([
            'user_id' => $request->employee,
            'purpose_moving' => $request->purpose_moving,
            'position' => $request->position
        ]);

        return redirect()->route('exit-mutations')->with(['success' => 'Berhasil Memperbarui Mutasi Keluar!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exit_Mutations  $exit_Mutations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $exit_mutation = Exit_Mutations::find($id);
        User::destroy($exit_mutation->user_id);

        return redirect()->route('exit-mutations')->with(['danger' => 'Berhasil Menghapus Mutasi Keluar!']);
    }

    public function exportExcel() {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        return Excel::download(
            new ExitMutationsExport(),
            "laporan_mutasi_keluar.xlsx"
        );
    }
}
