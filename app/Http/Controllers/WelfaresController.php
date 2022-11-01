<?php

namespace App\Http\Controllers;

use App\Models\Welfares;
use Illuminate\Http\Request;

class WelfaresController extends Controller
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

        $welfares = Welfares::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('pegawai.kesejahteraan.index', ['welfares' => $welfares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.kesejahteraan.store');
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
            'type' => 'min:2',
            'from' => 'min:3',
            'service' => 'min:3',
            'start_year' => 'min:4|max:4',
            'end_year' => 'min:4|max:4',
        ]);
        // dd(auth()->user()->id);
        Welfares::create(
            [
                'user_id' => (int)auth()->user()->id,
                'type' => $request->type,
                'service' => $request->service,
                'from' => $request->from,
                'start_year' => $request->start_year,
                'end_year' => $request->end_year,
            ]
            );

            return redirect()->route('welfares')->with(['success' => 'Berhasil Menambahkan Kesejahteraan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Welfares  $welfares
     * @return \Illuminate\Http\Response
     */
    public function show(Welfares $welfares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Welfares  $welfares
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $welfare = Welfares::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first();

        return view('pegawai.kesejahteraan.update', ['welfare' => $welfare]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Welfares  $welfares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'min:2',
            'from' => 'min:3',
            'service' => 'min:3',
            'start_year' => 'min:4|max:4',
            'end_year' => 'min:4|max:4',
        ]);

        Welfares::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first()
        ->update(
            [
                'type' => $request->type,
                'service' => $request->service,
                'from' => $request->from,
                'start_year' => $request->start_year,
                'end_year' => $request->end_year,
            ]
            );

         return redirect()->route('welfares')->with(['success' => 'Berhasil Memperbarui Kesejahteraan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Welfares  $welfares
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Welfares::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->delete();

        return redirect()->route('welfares')->with(['danger' => 'Berhasil Menghapus Kesejahteraan!']);
    }
}
