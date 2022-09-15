<?php

namespace App\Http\Controllers;

use App\User;
use App\Present;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        $rank = $users->firstItem();
        return view('users.index', compact('users','rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'nama'  => ['required', 'max:32', 'string'],
            'nrp'   => ['required', 'digits:9','unique:users'],
            'role'  => ['required', 'numeric'],
            'foto'  => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        $password = Str::random(10);
        $user['role_id'] = $request->role;
        $user['password'] = Hash::make($password);
        if ($request->file('foto')) {
            $user['foto'] = $request->file('foto')->store('foto-profil');
        } else {
            $user['foto'] = 'default.jpg';
        }

        User::create($user);
        return redirect('/users')->with('success', 'User berhasil ditambahkan, password = '.$password);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $presents = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->orderBy('tanggal','desc')->paginate(5);
        $masuk = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('masuk')->count();
        $telat = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('telat')->count();
        $cuti = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('cuti')->count();
        $alpha = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('alpha')->count();
        $kehadiran = Present::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('telat')->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse(config('absensi.jam_masuk'))));
        }
        $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        $kalender = file_get_contents($url);
        $kalender = json_decode($kalender, true);
        $libur = false;
        $holiday = null;
        if ($kalender['data'] != false) {
            if ($kalender['data']['holiday']['data']) {
                foreach ($kalender['data']['holiday']['data'] as $key => $value) {
                    if ($value['date'] == date('Y-m-d')) {
                        $holiday = $value['name'];
                        $libur = true;
                        break;
                    }
                }
            }
        }
        return view('users.show',compact('user','presents','libur','masuk','telat','cuti','alpha','totalJamTelat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama'  => ['required', 'max:32', 'string'],
            'nrp'   => ['required', 'digits:9',Rule::unique('users','nrp')->ignore($user)],
            'role'  => ['required', 'numeric'],
            'foto'  => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        $data['role_id'] = $request->role;
        if ($request->file('foto')) {
            if ($user->foto != 'default.jpg') {
                File::delete(public_path('storage'.'/'.$user->foto));
            }
            $data['foto'] = $request->file('foto')->store('foto-profil');
        }
        $user->update($data);
        return redirect()->back()->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $nama = $user->nama;
        if ($user->foto != 'default.jpg') {
            File::delete(public_path('storage'.'/'.$user->foto));
        }
        User::destroy($user->id);
        return redirect('/users')->with('success','User "'.$user->nama.'" berhasil dihapus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gantiPassword()
    {
        return view('users.ganti-password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password'                => 'required|min:6',
            'password_baru'           => 'required|min:6|required_with:konfirmasi_password|same:konfirmasi_password',
            'konfirmasi_password'     => 'required|min:6'
        ]);

        if (Hash::check($request->password, $user->password)) {
            if ($request->password == $request->konfirmasi_password) {
                return redirect()->back()->with('error','Password gagal diperbarui, tidak ada yang berubah pada kata sandi');
            } else {
                $user->password = Hash::make($request->konfirmasi_password);
                $user->save();
                return redirect()->back()->with('success','Password berhasil diperbarui');
            }
        } else {
            return redirect()->back()->with('error','Password tidak cocok dengan kata sandi lama');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil()
    {
        return view('users.profil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfil(Request $request, User $user)
    {
        $request->validate([
            'nama' => ['required', 'max:32'],
            'foto' => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        $user->nama = $request->nama;
        if ($request->file('foto')) {
            if ($user->foto != 'default.jpg') {
                File::delete(public_path('storage'.'/'.$user->foto));
            }
            $user->foto = $request->file('foto')->store('foto-profil');
        }
        $user->save();
        return redirect()->back()->with('success','Profil berhasil di perbarui');
    }

    public function search(Request $request)
    {
        $request->validate([
            'cari' => ['required']
        ]);
        $users = User::where('nama','like','%'.$request->cari.'%')
                    ->orWhere('nrp','like','%'.$request->cari.'%')
                    ->paginate(6);
        $rank = $users->firstItem();

        return view('users.index', compact('users','rank'));
    }

    public function password(Request $request, User $user)
    {
        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->back()->with('success','Password berhasil direset, Password = '.$password);
    }
}
