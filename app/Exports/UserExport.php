<?php

namespace App\Exports;

use App\Models\Employees;
use App\Models\Trainings;
use App\Models\Allowances;
use App\Models\Welfares;
use App\Models\Job_Experiences;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $employee = Employees::where('user_id', $this->id)->first();
        $trainings = Trainings::where('user_id', $this->id)->get();
        $allowances = Allowances::where('user_id', $this->id)->get();
        $job_experiences = Job_Experiences::where('user_id', $this->id)->get();
        $welfares = Welfares::where('user_id', $this->id)->get();

        return view('export-excel', [
            'employee' => $employee,
            'trainings' => $trainings,
            'allowances' => $allowances,
            'job_experiences' => $job_experiences,
            'welfares' => $welfares,
        ]);
    }
}
