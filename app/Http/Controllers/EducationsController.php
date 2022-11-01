<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use Illuminate\Http\Request;

class EducationsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Educations  $educations
     * @return \Illuminate\Http\Response
     */
    public function show(Educations $educations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Educations  $educations
     * @return \Illuminate\Http\Response
     */
    public function edit(Educations $educations)
    {
        $education = Educations::where('user_id', auth()->user()->id)->first();

        return view('pegawai.pendidikan.update', ['education' => $education]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Educations  $educations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educations $educations)
    {

        $request->validate([
            'last_education' => 'min:2',
            'education_stage' => 'min:2',
            'field_study' => 'min:4',
            'college_name' => 'min:4',
            'graduation_year' => 'min:4|max:4'
        ]);

        Educations::where('user_id', auth()->user()->id)->first()->update([
            "last_education" => $request->last_education,
            "education_stage" => $request->education_stage,
            "field_study" => $request->field_study,
            "college_name" => $request->college_name,
            "graduation_year" => $request->graduation_year
        ]);

        return redirect()->route('educations.edit')->with(['success' => 'Berhasil Memperbarui Riwayat Pendidikan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Educations  $educations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educations $educations)
    {
        //
    }
}
