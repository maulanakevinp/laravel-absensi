@extends('layouts.welcome')

@section('title')
    Welcome - {{ config('app.name') }}
@endsection

@section('content')
    @if (Route::has('login'))
        <div class="text-center">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
            @else
                <a href="{{ route('auth.index') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    @endif
@endsection