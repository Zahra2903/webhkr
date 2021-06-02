<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitDetailResource;
use App\Models\unit_detail;
use Illuminate\Http\Request;

class unit_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$unit_detail = unit_detail::paginate(2);
        //return $unit_detail;
        //return unit_detail::latest()->get();
        $unit_detail = unit_detail::get();
        return UnitDetailResource::collection($unit_detail);
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
            /* 'tim_id' => 'required',
            'unit_id' => 'required', */
        ]);
        $unit_detail = unit_detail::create([
            'tim_id'=> request('tim_id'),
            'unit_id'=> request('unit_id'),
        ]);
        
        if($unit_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Unit Detail Created',
                'data'    => $unit_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Unit Detail Failed to Save',
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
        return unit_detail::findorFail($id);
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
            /* 'tim_id' => 'required',
            'unit_id' => 'required', */
        ]);
        $unit_detail = unit_detail::findOrFail($id);
        $unit_detail->update($request->all());

        if($unit_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Unit Detail Updated',
                'data'    => $unit_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Unit Detail Failed to Update',
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
        $unit_detail = unit_detail::findorfail($id);
        $unit_detail->delete();
        return response()->json([
            'message' => 'Unit Detail deleted successfully'
        ]);
    }
}