@extends('layouts.app')
@section('title')
Ganti Password - {{ config('app.name') }}
@endsection
@section('content')

<!-- Begin Page Content -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold">Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action=" {{ route('update-password', Auth::user()->id) }} " method="post">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" class="form-control  @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru">
                            @error('password_baru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" class="form-control  @error('konfirmasi_password') is-invalid @enderror" id="konfirmasi_password" name="konfirmasi_password">
                            @error('konfirmasi_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
