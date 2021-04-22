<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$unit = unit::paginate(2);
        //return $unit;
        return unit::latest()->get();
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
            'nama' => 'required',
            'kategori' => 'required',
            'keterangan' => 'required',
        ]);
        $unit = unit::create([
            'nama'=> request('nama'),
            'kategori'=> request('kategori'),
            'keterangan'=> request('keterangan'),
        ]);
        
        if($unit) {
            return response()->json([
                'success' => true,
                'message' => 'Unit Created',
                'data'    => $unit
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Unit Failed to Save',
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
        return unit::findorFail($id);
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
            'nama' => 'required',
            'kategori' => 'required',
            'keterangan' => 'required',
        ]);
        $unit = unit::findOrFail($id);
        $unit->update($request->all());

        if($unit) {
            return response()->json([
                'success' => true,
                'message' => 'Unit Updated',
                'data'    => $unit
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Unit Failed to Update',
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
        $unit = unit::findorfail($id);
        $unit->delete();
        return response()->json([
            'message' => 'Unit deleted successfully'
        ]);
    }
}