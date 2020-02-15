@extends('layouts.app')
@section('title')
    Home - {{ config('app.name') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow h-100">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Selamat datang {{ Auth::user()->nama }}!
                    @if ($present)
                        @if ($present->keterangan == 'Alpha')
                            <br>Anda belum melakukan check in silahkan check-in 
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-success" type="submit">Check-in</button>
                            </form>
                        @else
                            <br>
                            Anda telah melakukan check-in hari ini pukul ({{ ($present->jam_masuk) }})
                            @if ($present->jam_keluar)
                                <br>
                                Anda telah melakukan check-out hari ini pukul ({{ $present->jam_keluar }})
                            @else
                                <br>
                                Jika pekerjaan telah selesai silahkan check-out 
                                <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                                    @csrf @method('patch')
                                    <button class="btn btn-success" type="submit">Check-out</button>
                                </form>
                            @endif
                        @endif
                    @else
                        <br>Anda belum melakukan check in silahkan check-in 
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-success" type="submit">Check-in</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
