<?php

namespace App\Exports;

use App\Models\Exit_Mutations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExitMutationsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $exit_mutations = Exit_Mutations::all();

        return view('admin.mutasiKeluar.export-excel', ['exit_mutations' => $exit_mutations]);
    }
}
