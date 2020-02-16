@extends('layouts.welcome')
@section('title')
    Home - {{ config('app.name') }}
@endsection
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow h-100">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Selamat datang {{ Auth::user()->nama }}! --}}
                    @if ($present)
                        @if ($present->keterangan == 'Alpha')
                            <div class="text-center">
                                <p>Silahkan check-in terlebih dahulu</p>
                                <form action="{{ route('kehadiran.check-in') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button class="btn btn-primary" type="submit">Check-in</button>
                                </form>
                            </div>
                        @else
                            <div class="text-center">
                                <p>
                                    Check-in hari ini pukul : ({{ ($present->jam_masuk) }})
                                </p>
                                @if ($present->jam_keluar)
                                    <p>Check-out hari ini pukul : ({{ $present->jam_keluar }})</p>
                                @else
                                    <p>Jika pekerjaan telah selesai silahkan check-out</p>
                                    <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                                        @csrf @method('patch')
                                        <button class="btn btn-primary" type="submit">Check-out</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="text-center">
                            <p>Silahkan check-in terlebih dahulu</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">Check-in</button>
                            </form>
                        </div>
                    @endif
                {{-- </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
