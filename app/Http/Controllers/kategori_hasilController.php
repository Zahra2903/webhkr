<?php

namespace App\Http\Controllers;

use App\Models\kategori_hasil;
use Illuminate\Http\Request;

class kategori_hasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$kategori_hasil = kategori_hasil::paginate(2);
        //return $kategori_hasil;
        return kategori_hasil::latest()->get();
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
            'nilai_atas' => 'required',
            'nilai_bawah' => 'required',
            'nama' => 'required',

        ]);
        $kategori_hasil = kategori_hasil::create([
            'nilai_atas'=> request('nilai_atas'),
            'nilai_bawah'=> request('nilai_bawah'),
            'nama'=> request('nama'),
        ]);
        
        if($kategori_hasil) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori Hasil Created',
                'data'    => $kategori_hasil
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kategori Hasil Failed to Save',
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
        return kategori_hasil::findorFail($id);
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
            'nilai_atas' => 'required',
            'nilai_bawah' => 'required',
            'nama' => 'required',
        ]);
        $kategori_hasil = kategori_hasil::findOrFail($id);
        $kategori_hasil->update($request->all());

        if($kategori_hasil) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori Hasil Updated',
                'data'    => $kategori_hasil
            ], 200);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kategori Hasil Failed to Update',
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
        $kategori_hasil = kategori_hasil::findorfail($id);
        $kategori_hasil->delete();
        return response()->json([
            'message' => 'Kategori Hasil deleted successfully'
        ]);
    }
}