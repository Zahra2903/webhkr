<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenilaianDetailResource;
use App\Models\penilaian_detail;
use Illuminate\Http\Request;

class penilaian_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$penilaian_detail = penilaian_detail::paginate(2);
        //return $penilaian_detail;
        //return penilaian_detail::latest()->get();
        $penilaian_detail = penilaian_detail::latest()->get();
        return PenilaianDetailResource::collection($penilaian_detail);
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
            /* 'kriteria_id' => 'required',
            'penilaian_id' => 'required', */
            'nilai' => 'required',
        ]);
        $penilaian_detail = penilaian_detail::create([
            'kriteria_id'=> request('kriteria_id'),
            'penilaian_id'=> request('penilaian_id'),
            'nilai'=> request('nilai'),
        ]);

        if($penilaian_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Penilaian Detail Created',
                'data'    => $penilaian_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Penilaian Detail Failed to Save',
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
        return penilaian_detail::findorFail($id);
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
            /* 'kriteria_id' => 'required',
            'penilaian_id' => 'required', */
            'nilai' => 'required',
        ]);
        $penilaian_detail = penilaian_detail::findOrFail($id);
        $penilaian_detail->update($request->all());

        if($penilaian_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Penilaian Detail Updated',
                'data'    => $penilaian_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Penilaian Detail Failed to Update',
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
        $penilaian_detail = penilaian_detail::findorfail($id);
        $penilaian_detail->delete();
        return response()->json([
            'message' => 'Penilaian Detail deleted successfully'
        ]);
    }
}
