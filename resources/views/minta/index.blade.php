@extends('layouts.app')
@section('title', 'Banner')
@section('content')
    <h4>Daftar Permintaan</h4>
    <div class="table-responsive">
        @can('access','minta_create')
            <a class="btn btn-info mb-4" href="{{ route('minta.create') }}">Tambah Permintaan</a>
        @endcan
        <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
        <table
            class="table table-hover table-bordered convert-data-table display">
            <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Tanggal Dibutuhkan</th>
                <th>No Faktur</th>
                <th>ID User Pemohon</th>
                <th>ID User Menyetujui</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Updated At</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $minta)
                <tr>
                    <td>
                        @can('access', 'minta_update')
                            <a href="{{ route('minta.edit', base64_encode($minta->id)) }}"
                               class="btn btn-warning">Edit</a>
                        @endcan
                        @can('access', 'minta_read')
                            <a href="{{ route('minta.show', base64_encode($minta->id)) }}"
                               class="btn btn-success mt-3">Show</a>
                        @endcan
                    </td>
                    <td>{{ $minta->id }}</td>
                    <td>{{ $minta->tanggal }}</td>
                    <td>{{ $minta->tanggal_dibutuhkan }}</td>
                    <td>{{ $minta->no_faktur }}</td>
                    <td>{{ $minta->id_user_pemohon }}</td>
                    <td>{{ $minta->id_user_menyetujui }}</td>
                    <td>{{ $minta->status }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $minta->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $minta->created_id }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $minta->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $minta->updated_id }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
