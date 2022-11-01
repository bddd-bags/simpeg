<?php

namespace App\Exports;

use App\Models\Incoming_Mutations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IncomingMutationsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $incoming_mutations = Incoming_Mutations::all();

        return view('admin.mutasiMasuk.export-excel', ['incoming_mutations' => $incoming_mutations]);
    }
}
