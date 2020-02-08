<?php

namespace App\Exports;

use App\Present;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Fromview;

class PresentExport implements Fromview
{

    private $user_id, $bulan;

    public function __construct($user_id, $bulan) {
        $this->user_id = $user_id;
        $this->bulan = $bulan;
    }
    
    public function view(): view
    {
        $data = explode('-',$this->bulan);
        $presents = Present::whereUserId($this->user_id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->orderBy('tanggal','desc')->get();
        return view('presents.excel-user', compact('presents'));
    }
}
