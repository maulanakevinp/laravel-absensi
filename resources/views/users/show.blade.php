@extends('layouts.app')
@section('title')
Detail User - {{ config('app.name') }}
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Detail User</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <img src="{{ Storage::url($user->foto) }}" class="card-img mb-3" alt="{{ $user->foto }}">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr><td>NRP</td><td>:</td><td>{{ $user->nrp }}</td></tr>
                                    <tr><td>Nama</td><td>:</td><td>{{ $user->nama }}</td></tr>
                                    <tr><td>Sebagai</td><td>:</td><td>{{ $user->role->role }}</td></tr>
                                </tbody>
                            </table>
                            <div class="float-right">
                                <a href="{{ route('users.edit',$user) }}" class="btn btn-warning">Ubah</a>
                                @if ($user->id != auth()->user()->id)
                                    <form class="d-inline-block" action="{{ route('users.destroy',$user) }}" method="post">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus user ini ???')">Hapus</button>
                                    </form>
                                @endif
                                <form class="d-inline-block" action="{{ route('users.password',$user) }}" method="post">
                                    @csrf @method('patch')
                                    <button type="submit" class="btn btn-dark" onclick="return confirm('Apakah anda yakin ingin mereset password user ini ???')">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Kehadiran</h5>
                        <a href="{{ route('kehadiran.create') }}" class="btn btn-sm btn-success float-right">Tambah Kehadiran</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kehadiran.cari') }}" class="mb-3" method="get">
                            <div class="input-group mb-3">
                                <input type="month" class="form-control" name="bulan" id="bulan">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Total Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

@endsection
