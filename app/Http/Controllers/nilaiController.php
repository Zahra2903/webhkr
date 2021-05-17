<?php

namespace App\Http\Controllers;

use App\Http\Resources\NilaiResource;
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
        
        $data = nilai::latest()->get();
        return NilaiResource::collection($data);
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
            /* 'kriteria_id' => 'required', */
            'nilai' => 'required',
            'keterangan' => 'required',
        ]);
        $data = nilai::create([
            'kriteria_id'=> request('kriteria_id'),
            'nilai'=> request('nilai'),
            'keterangan'=> request('keterangan'),
        ]);
        
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Nilai Created',
                'data'    => $data
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
           /*  'kriteria_id' => 'required', */
            'nilai' => 'required',
            'keterangan' => 'required',
        ]);
        $data = nilai::findOrFail($id);
        $data->update($request->all());

        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Nilai Updated',
                'data'    => $data
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
        $data = nilai::findorfail($id);
        $data->delete();
        return response()->json([
            'message' => 'Nilai deleted successfully'
        ]);
    }
}