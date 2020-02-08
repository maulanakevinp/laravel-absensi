@extends('layouts.app')
@section('title')
Detail User - {{ config('app.name') }}
@endsection
@section('content')

    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Kehadiran</h5>
                <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#kehadiran">
                    Tambah Kehadiran
                </button>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-hadir.cari') }}" class="mb-3" method="get">
                    <div class="form-group row mb-3 ">
                        <label for="bulan" class="col-form-label col-sm-2">Bulan</label>
                        <div class="input-group col-sm-10">
                            <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
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
                            @foreach ($presents as $present)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($present->tanggal)) }}</td>
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
                    <div class="float-right">
                        {{ $presents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection