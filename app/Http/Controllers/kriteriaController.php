<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use Illuminate\Http\Request;

class kriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$kriteria = kriteria::paginate(2);
        //return $kriteria;
        return kriteria::get();
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
            'kriteria' => 'required',
            'sub_kriteria' => 'required',
        ]);
        $kriteria = kriteria::create([
            'kriteria'=> request('kriteria'),
            'sub_kriteria'=> request('sub_kriteria'),
        ]);
        
        if($kriteria) {
            return response()->json([
                'success' => true,
                'message' => 'Kriteria Created',
                'data'    => $kriteria
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kriteria Failed to Save',
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
        return kriteria::findorFail($id);
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
            'kriteria' => 'required',
            'sub_kriteria' => 'required',
        ]);
        $kriteria = kriteria::findOrFail($id);
        $kriteria->update($request->all());

        if($kriteria) {
            return response()->json([
                'success' => true,
                'message' => 'Kriteria Updated',
                'data'    => $kriteria
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kriteria Failed to Update',
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
        $kriteria = kriteria::findorfail($id);
        $kriteria->delete();
        return response()->json([
            'message' => 'Kriteria deleted successfully'
        ]);
    }
}