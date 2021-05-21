<?php

namespace App\Http\Controllers;

use App\Http\Resources\TimResource;
use App\Models\tim;
use Illuminate\Http\Request;

class timController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tim = tim::latest()->get();
        return TimResource::collection($tim);
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
            'nama_tim' => 'required',
        ]);
        $tim = tim::create([
            'nama_tim'=> request('nama_tim'),
        ]);
        
        if($tim) {
            return response()->json([
                'success' => true,
                'message' => 'Tim Created',
                'data'    => $tim
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Tim Failed to Save',
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
        return tim::findorFail($id);
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
            'nama_tim' => 'required',
        ]);
        $tim = tim::findOrFail($id);
        $tim->update($request->all());

        if($tim) {
            return response()->json([
                'success' => true,
                'message' => 'Tim Updated',
                'data'    => $tim
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Tim Failed to Update',
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
        $tim = tim::findorfail($id);
        $tim->delete();
        return response()->json([
            'message' => 'Tim deleted successfully'
        ]);
    }
}