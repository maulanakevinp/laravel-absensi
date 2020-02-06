<?php

namespace App\Http\Controllers;

use App\Present;
use Illuminate\Http\Request;

class PresentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presents\index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function show(Present $kehadiran)
    {
        return view('presents.show',compact('kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function edit(Present $present)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Present $present)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function destroy(Present $present)
    {
        //
    }
}
