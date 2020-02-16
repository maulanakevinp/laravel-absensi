@extends('layouts.welcome')

@section('title')
    Login - {{ config('app.name') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}" role="form">
        @csrf
        <div class="form-group mb-3">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                </div>
                <input id="nrp" type="nrp" onkeypress="return hanyaAngka(event)" class="form-control @error('nrp') is-invalid @enderror" name="nrp" value="{{ old('nrp') }}" autocomplete="nrp" autofocus placeholder="Masukkan NRP ...">
                @error('nrp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Masukkan Password ...">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-4">Login</button>
        </div>
    </form>
@endsection