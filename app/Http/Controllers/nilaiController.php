<?php

namespace App\Http\Controllers;

use App\Models\nilai;
use Illuminate\Http\Request;

class nilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$nilai = nilai::paginate(2);
        //return $nilai;
        return nilai::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'kriteria_id' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required',
        ]);
        $nilai = nilai::create([
            'kriteria_id'=> request('kriteria_id'),
            'nilai'=> request('nilai'),
            'keterangan'=> request('keterangan'),
        ]);
        
        if($nilai) {
            return response()->json([
                'success' => true,
                'message' => 'Nilai Created',
                'data'    => $nilai
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Nilai Failed to Save',
        ], 409);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return nilai::findorFail($id);
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
        $this->validate($request, [
            'kriteria_id' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required',
        ]);
        $nilai = nilai::findOrFail($id);
        $nilai->update($request->all());

        if($nilai) {
            return response()->json([
                'success' => true,
                'message' => 'Nilai Updated',
                'data'    => $nilai
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Nilai Failed to Update',
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = nilai::findorfail($id);
        $nilai->delete();
        return response()->json([
            'message' => 'Nilai deleted successfully'
        ]);
    }
}