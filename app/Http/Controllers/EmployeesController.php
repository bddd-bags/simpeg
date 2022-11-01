<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Models\Roles;
use App\Models\Employees;
use App\Models\Trainings;
use App\Models\Welfares;
use App\Models\Allowances;
use App\Models\Job_Experiences;
use App\Models\Educations;
use App\Models\Familys;
use App\Models\User;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
    }

    public function index(Request $request)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $employees = Employees::with('user')->latest();

        if ($request->search) {
            $employees->where("nidn", "like", "%" . $request->search . "%");

            return view("pegawai.index", [
                "employees" => $employees->paginate(10)->withQueryString(),
            ]);
        }

        return view('pegawai.index', ['employees' => $employees->paginate(10)]);
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

        $roles = Roles::get();
        
        return view('pegawai.store', ['roles' => $roles]);
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
            'username' => 'min:5',
            'password' => 'min:6'
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => (int)$request->role,
            'is_active' => true,
        ]); 

        // dd($user->id);

        Employees::create([
            'user_id' => $user->id
        ]);

        Familys::create([
            'user_id' => $user->id
        ]);

        Educations::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('employees')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        Employees::where('user_id', $id)->first();

        $employee = Employees::where('user_id', $id)->first();
        $education = Educations::where('user_id', $id)->first();
        $family = Familys::where('user_id', $id)->first();
        $trainings = Trainings::where('user_id', $id)->paginate(10);
        $welfares = Welfares::where('user_id', $id)->paginate(10);
        $allowances = Allowances::where('user_id', $id)->paginate(10);
        $job_experiences = Job_Experiences::where('user_id', $id)->paginate(10);

        return view('pegawai.detail', [
            'employee' => $employee, 
            'education' => $education,
            'family' => $family,
            'trainings' => $trainings,
            'welfares' => $welfares,
            'job_experiences' => $job_experiences,
            'allowances' => $allowances,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $employee = Employees::find($id);
        $roles = Roles::get();
        // dd($employee->user->role_id == $roles->id);
        return view('pegawai.update', ['employee' => $employee, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        $request->validate([
            'username' => 'min:5',
            'password' => 'min:6'
        ]);

        $employee = Employees::find($id);

        User::find($employee->user_id)->update([
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => (int)$request->role
        ]);

        return redirect()->route('employees')->with(['success' => 'Berhasil Memperbarui Data Pegawai!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        User::destroy($id);

        return redirect()->route('employees')->with(['danger' => 'Data Berhasil Dihapus!']);
    }

    public function exportExcel() {
        if(!Gate::allows('admin')) 
        {
            return abort('403', 'Forbidden');
        }

        return Excel::download(
            new EmployeesExport(),
            "laporan_kepegawaian.xlsx"
        );
    }
}
