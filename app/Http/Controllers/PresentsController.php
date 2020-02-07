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
        $present = Present::whereUserId($request->user_id)->whereTanggal(date('Y-m-d'))->first();
        if ($present) {
            return redirect()->back()->with('error','Absensi hari ini telah terisi');
        }
        if (auth()->user()->role_id == 1) {
            $data = $request->validate([
                'keterangan'    => ['required'],
                'user_id'    => ['required']
            ]);
            $data['tanggal'] = date('Y-m-d');
            if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
                $data['jam_masuk'] = $request->jam_masuk;
                if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                    $data['keterangan'] = 'Masuk';
                } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                    $data['keterangan'] = 'Telat';
                } else {
                    $data['keterangan'] = 'Alpha';
                }
            }
            Present::create($data);
            return redirect()->back()->with('success','Kehadiran berhasil ditambahkan');
        } else {
            $data['jam_masuk']= date('H:i:s');
            $data['tanggal'] = date('Y-m-d');
            if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                $data['keterangan'] = 'Masuk';
            } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                $data['keterangan'] = 'Telat';
            } else {
                $data['keterangan'] = 'Alpha';
            }
            
            Present::create($data);
            return redirect()->back()->with('success','Kehadiran berhasil ditambahkan');
        }
    }

    public function ubah(Request $request)
    {
        $present = Present::findOrFail($request->id);
        echo json_encode($present);
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
        if (auth()->user()->role_id) {
            # code...
        }
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
