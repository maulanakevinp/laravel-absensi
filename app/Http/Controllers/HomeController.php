<?php

namespace App\Http\Controllers;

use App\Present;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $present = Present::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();
        $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        $kalender = file_get_contents($url);
        $kalender = json_decode($kalender, true);
        $libur = false;
        $holiday = null;
        if ($kalender['Data'] != false) {
            for ($i=0; $i < count($kalender['Data']); $i++) { 
                if ($kalender['Data'][$i]['Date']['M'] == date('Y-m-d')) {
                    $libur = true;
                    $translate = $kalender['Data'][$i]['Holiday']['Name'];
                    $holiday = $kalender['Translate'][$translate];
                    break;
                }
            }
        }
        return view('home', compact('present','libur','holiday'));
    }
}
