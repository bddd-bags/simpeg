<?php

namespace App\Exports;

use App\Models\Employees;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $employees = Employees::all();
        // dd($employees->familys->wedding_status);

        return view('pegawai.export-excel', ['employees' => $employees]);
    }
}
