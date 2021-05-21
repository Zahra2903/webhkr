<?php

namespace App\Http\Controllers;

use App\Models\tim_detail;
use App\Http\Resources\TimDetailResource;
use Illuminate\Http\Request;

class tim_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tim_detail = tim_detail::paginate(2);
        //return $tim_detail;
        //return tim_detail::latest()->get();
        $tim_detail = tim_detail::get();
        return TimDetailResource::collection($tim_detail);
        //return $tim_detail;
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
            'nik' => 'required',
        ]);

        $tim_detail = tim_detail::create([
            'tim_id' => request('tim_id'),
            'nik' => request('nik'),
        ]);

        if ($tim_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Tim Detail Created',
                'data'    => $tim_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Tim Detail Failed to Save',
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
       
        $cek = tim_detail::where('nik', $id)->get();
        if($cek->isEmpty())
        {
            return response()->json([
                'success' => true,
            ], 200);
        }
        else 
        {
            return response()->json([
                'success' => false,
            ], 200);
        }

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
            /* 'tim_id' => 'required', */
            'nik' => 'required',

        ]);
        $tim_detail = tim_detail::findOrFail($id);
        $tim_detail->update($request->all());

        if($tim_detail) {
            return response()->json([
                'success' => true,
                'message' => 'Tim Detail Updated',
                'data'    => $tim_detail
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Tim Detail Failed to Update',
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
        $tim_detail = tim_detail::findorfail($id);
        $tim_detail->delete();
        return response()->json([
            'message' => 'Tim Detail deleted successfully'
        ]);
    }
}
