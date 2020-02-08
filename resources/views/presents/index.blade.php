@extends('layouts.app')
@section('title')
Kehadiran - {{ config('app.name') }}
@endsection
@section('content')

<!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Kehadiran</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        <form action="{{ route('kehadiran.search') }}" method="get">
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-2">Tanggal</label>
                                <div class="input-group col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            {{ $presents->links() }}
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
                                <th>Keterangan</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Total Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presents as $present)
                                <tr>
                                    <th>{{ $rank++ }}</th>
                                    <td><a href="{{ route('users.show',$present->user) }}">{{ $present->user->nrp }}</a></td>
                                    <td>{{ $present->user->nama }}</td>
                                    <td>{{ $present->keterangan }}</td>
                                    @if ($present->jam_masuk)
                                        <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if($present->jam_keluar)
                                        <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                                        <td>
                                            @if (strtotime($present->jam_keluar) <= strtotime($present->jam_masuk))
                                                {{ 21 - (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) }}
                                            @else 
                                                @if (strtotime($present->jam_keluar) >= strtotime('19:00:00'))
                                                    {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 3 }}
                                                @else
                                                    {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 1 }}
                                                @endif
                                            @endif
                                        </td>
                                    @else
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
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
