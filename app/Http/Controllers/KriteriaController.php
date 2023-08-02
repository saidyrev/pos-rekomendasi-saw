<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kriteria.index');
    }

    public function data()
    {
        $kriteria = Kriteria::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kriteria)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kriteria){
                return '
                <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a onclick="editForm(`'. route('kriteria.update', $kriteria->id) .'`)" class="dropdown-item" ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a onclick="deleteData(`'. route('kriteria.destroy', $kriteria->id) .'`)" class="dropdown-item" ><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
        $kriteria = new Kriteria();
        $kriteria = Kriteria::create($request->all());
        // $kriteria->nama_kriteria = $request->nama_kriteria;
        // $kriteria->save();

        // return redirect('/saw')->withToastSuccess('Kategori Berhasil Disimpan');
        return response()->json(['success'=>'Kategori Berhasil Disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kriteria = Kriteria::find($id);

        return response()->json($kriteria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
