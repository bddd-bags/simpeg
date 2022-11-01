<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Employees;
use App\Models\Educations;
use App\Models\Familys;
use App\Models\Welfares;
use App\Models\Trainings;
use App\Models\Allowances;
use App\Models\Job_Experiences;
use App\Models\Genders;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("isActive");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(!Gate::allows('admin')) {
        //     return abort('403', 'Forbidden');
        // }
        $employee = Employees::where('user_id', auth()->user()->id)->first();
        $education = Educations::where('user_id', auth()->user()->id)->first();
        $family = Familys::where('user_id', auth()->user()->id)->first();
        $trainings = Trainings::where('user_id', auth()->user()->id)->paginate(10);
        $welfares = Welfares::where('user_id', auth()->user()->id)->paginate(10);
        $allowances = Allowances::where('user_id', auth()->user()->id)->paginate(10);
        $job_experiences = Job_Experiences::where('user_id', auth()->user()->id)->paginate(10);

        return view('dashboard', [
            'employee' => $employee, 
            'education' => $education,
            'family' => $family,
            'trainings' => $trainings,
            'welfares' => $welfares,
            'job_experiences' => $job_experiences,
            'allowances' => $allowances,
        ]);
    }

    // public function store() {
    //     return view('store');
    // }

    // public function dashboard() {
    //     return view('dashboard');
    // }

    public function profile() {

        $employee = Employees::where('user_id', auth()->user()->id)->first();
        // dd($employee);

        // dd(!!$employee->picture);

        return view('profile', ['employee' => $employee]);
    }

    public function edit() {
        $employee = Employees::where('user_id', auth()->user()->id)->first();
        $genders = Genders::get();
        // dd($employee);

        return view('uprofile', 
        [
            'employee' => $employee,
            'genders' => $genders
        ]);
    }

    public function update(Request $request) {

        if(!$request->file("picture")) {
            $employee = Employees::where('user_id', auth()->user()->id)->update([
                'fullname' => $request->fullname,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'gender_id' => $request->gender,
                "birth_place" => $request->birth_place,
                "birth_date" => $request->birth_date,
                'email_active' => $request->email,
                'religion' => $request->religion,
                'address' => $request->address,
                'no_telp' => $request->no_telp,
            ]);
    
            User::find(auth()->user()->id)->update([
                'name' => $request->username
            ]);
    
            return redirect()->route('profile')->with(['success' => 'Data Berhasil Diperbarui!']);
        }

        Storage::delete($request->oldPictures);
        $picture = $request->file("picture")->store("picture");
    
        $employee = Employees::where('user_id', auth()->user()->id)->update([
            'fullname' => $request->fullname,
            'nip' => $request->nip,
            'nik' => $request->nik,
            'gender_id' => $request->gender,
            "birth_place" => $request->birth_place,
            "birth_date" => $request->birth_date,
            'email_active' => $request->email,
            'religion' => $request->religion,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'picture' => $picture,
        ]);
    
        User::find(auth()->user()->id)->update([
            'name' => $request->username
        ]);

        return redirect()->route('profile')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    public function exportExcel() {

        $employee = Employees::where('user_id', auth()->user()->id)->first();
        return Excel::download(
            new UserExport(auth()->user()->id),
            "laporan_data_pegawai_" . $employee->fullname .".xlsx"
        );
    }
}
