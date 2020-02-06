@extends('layouts.app')
@section('title')
Users Management - {{ config('app.name') }}
@endsection
@section('content')

<!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Users Management</h5>
                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">Tambah User</a>
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
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $rank++ }}</th>
                                    <td>{{ $user->nrp }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->role->role }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
