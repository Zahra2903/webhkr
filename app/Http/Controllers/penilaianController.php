<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenilaianResource;
use App\Models\penilaian;
use Illuminate\Http\Request;

class penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$penilaian = penilaian::paginate(2);
        //return $penilaian;
        //return penilaian::latest()->get();
        $penilaian = penilaian::latest()->get();
        return PenilaianResource::collection($penilaian);
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
            'tanggal' => 'required',
            'nik' => 'required',
            'tim_id' => 'required',
            'unit_id' => 'required',
            'status' => 'required',
            'rekomendasi' => 'required',
        ]);
        $penilaian = penilaian::create([
            'tanggal'=> request('tanggal'),
            'nik'=> request('nik'),
            'tim_id'=> request('tim_id'),
            'unit_id'=> request('unit_id'),
            'status'=> request('status'),
            'rekomendasi'=> request('rekomendasi'),
        ]);
        
        if($penilaian) {
            return response()->json([
                'success' => true,
                'message' => 'Penilaian Created',
                'data'    => $penilaian
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Penilaian Failed to Save',
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
        return penilaian::findorFail($id);
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
            'tanggal' => 'required',
            'nik' => 'required',
            'tim_id' => 'required',
            'unit_id' => 'required',
            'status' => 'required',
            'rekomendasi' => 'required',
        ]);
        $penilaian = penilaian::findOrFail($id);
        $penilaian->update($request->all());

        if($penilaian) {
            return response()->json([
                'success' => true,
                'message' => 'Penilaian Updated',
                'data'    => $penilaian
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Penilaian Failed to Update',
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
        $penilaian = penilaian::findorfail($id);
        $penilaian->delete();
        return response()->json([
            'message' => 'Tim Detail deleted successfully'
        ]);
    }
}