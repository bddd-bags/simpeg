<?php

namespace App\Http\Controllers;

use App\Models\Trainings;
use Illuminate\Http\Request;

class TrainingsController extends Controller
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
        $trainings = Trainings::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('pegawai.pelatihan.index', ['trainings' => $trainings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.pelatihan.store');
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
            'type' => 'min:2',
            'organizer' => 'min:3',
            'status' => 'min:3',
            'year' => 'min:4|max:4',
        ]);

        Trainings::create([
            'user_id' => (int)auth()->user()->id,
            'name' => $request->name,
            'type' => $request->type,
            'organizer' => $request->organizer,
            'year' => $request->year,
            'status' => $request->status
        ]);

        return redirect()->route('trainings')->with(['success' => 'Berhasil Menambahkan Pelatihan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function show(Trainings $trainings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Trainings::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first();

        return view('pegawai.pelatihan.update', ['training'=> $training]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'min:3',
            'type' => 'min:2',
            'organizer' => 'min:3',
            'status' => 'min:3',
            'year' => 'min:4|max:4',
        ]);

        $training = Trainings::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
            ])->first()->update([
                // 'user_id' => (int)auth()->user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'organizer' => $request->organizer,
                'year' => $request->year,
                'status' => $request->status
            ]);

        return redirect()->route('trainings')->with(['success' => 'Berhasil Memperbarui Pelatihan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trainings::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
            ])->delete();

        return redirect()->route('trainings')->with(['danger' => 'Berhasil Menghapus Pelatihan!']);
    }
}
