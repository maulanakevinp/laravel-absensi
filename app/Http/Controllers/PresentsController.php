<?php

namespace App\Http\Controllers;

use App\Present;
use App\User;
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
        $presents = Present::whereTanggal(date('Y-m-d'))->paginate(6);
        $rank = $presents->firstItem();
        return view('presents.index', compact('presents','rank'));
    }

    public function search(Request $request)
    {
        $presents = Present::whereTanggal($request->tanggal)->paginate(6);
        $rank = $presents->firstItem();
        return view('presents.index', compact('presents','rank'));
    }

    public function cari(Request $request, User $user)
    {
        $data = explode('-',$request->bulan);
        $presents = Present::whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->paginate(5);
        return view('users.show', compact('presents','user'));
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
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(Present $kehadiran)
    {
        return view('presents.show',compact('kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Present $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Present $kehadiran)
    {
        if (auth()->user()->role_id) {
            $data = $request->validate([
                'keterangan'    => ['required']
            ]);

            if ($request->jam_keluar) {
                $data['jam_keluar'] = $request->jam_keluar;
            }

            if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
                $data['jam_masuk'] = $request->jam_masuk;
                if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                    $data['keterangan'] = 'Masuk';
                } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                    $data['keterangan'] = 'Telat';
                } else {
                    $data['keterangan'] = 'Alpha';
                }
            } else {
                $data['jam_masuk'] = null;
                $data['jam_keluar'] = null;
            }
            $kehadiran->update($data);
            return redirect()->back()->with('success', 'Kehadiran tanggal "'.date('l, d F Y',strtotime($kehadiran->tanggal)).'" berhasil diubah');
        } else {
            $data['jam_keluar'] = $request->jam_keluar;
            $kehadiran->update($data);
            return redirect()->back()->with('success', 'Kehadiran tanggal "'.date('l, d F Y',strtotime($kehadiran->tanggal)).'" berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Present $kehadiran)
    {
        //
    }
}
