<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$karyawan = karyawan::paginate(2);
        //return $karyawan;
        return karyawan::orderBy('nama','asc')->get();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return karyawan::findorFail($id);
    }     
}