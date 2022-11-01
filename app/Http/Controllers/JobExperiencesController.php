<?php

namespace App\Http\Controllers;

use App\Models\Job_Experiences;
use App\Models\Places;
use Illuminate\Http\Request;

class JobExperiencesController extends Controller
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
        $job_experiences = Job_Experiences::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('pegawai.riwayatPekerjaan.index', ['job_experiences' => $job_experiences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Places::get();

        return view('pegawai.riwayatPekerjaan.store', ['places' => $places]);
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
            'name' => 'min:3',
            'description' => 'min:4',
            'start_year' => 'min:4|max:4',
            'end_year' => 'min:4|max:4',
        ]);

        Job_Experiences::create([
            'user_id' => (int)auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'place_id' => (int)$request->place,
        ]);

        return redirect()->route('job-experiences')->with(['success' => 'Berhasil Menambahkan Riwayat Pekerjaan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job_Experiences  $job_Experiences
     * @return \Illuminate\Http\Response
     */
    public function show(Job_Experiences $job_Experiences)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job_Experiences  $job_Experiences
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job_experience = Job_Experiences::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first();
        $places = Places::get();

        return view('pegawai.riwayatPekerjaan.update', ['job_experience' => $job_experience, 'places' => $places]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job_Experiences  $job_Experiences
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'min:3',
            'description' => 'min:4',
            'start_year' => 'min:4|max:4',
            'end_year' => 'min:4|max:4',
        ]);
        
        $job_experience = Job_Experiences::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first()
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'place_id' => (int)$request->place,
        ]);

        return redirect()->route('job-experiences')->with(['success' => 'Berhasil Memperbarui Riwayat Pekerjaan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job_Experiences  $job_Experiences
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job_experience = Job_Experiences::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->delete();

        return redirect()->route('job-experiences')->with(['success' => 'Berhasil Menghapus Riwayat Pekerjaan!']);
    }
}
