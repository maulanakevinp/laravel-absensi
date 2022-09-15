@extends('layouts.app')

@section('title')
Users Management - {{ config('app.name') }}
@endsection

@section('header')
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total User</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $users->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Users Management</h5>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right" title="Tambah User"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{ route('users.search') }}" method="get">
                            <input type="text" name="cari" id="cari" class="form-control mb-3" value="{{ request('cari') }}" placeholder="Cari . . ." autocomplete="off">
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Sebagai</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$users->count())
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                            @else
                                @foreach ($users as $user)
                                    <tr>
                                        <th>{{ $rank++ }}</th>
                                        <td>{{ $user->nrp }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->role->role }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info" title="Detail User"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
