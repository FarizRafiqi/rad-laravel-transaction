@extends('layouts.app')
@section('title', 'Banner')
@section('content')
    <h4>Daftar Barang</h4>
    <div class="table-responsive">
        @can('access','barang_create')
            <a class="btn btn-info mb-4" href="{{ route('barang.create') }}">Tambah Barang</a>
        @endcan

        <table
            class="table table-hover table-bordered convert-data-table display">
            <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Keterangan</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Updated At</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $barang)
                <tr>
                    <td>
                        @can('access', 'barang_update')
                            <a href="{{ route('barang.edit', base64_encode($barang->id)) }}"
                               class="btn btn-warning">Edit</a>
                        @endcan
                        @can('access', 'barang_read')
                            <a href="{{ route('barang.show', base64_encode($barang->id)) }}"
                               class="btn btn-success">Show</a>
                        @endcan
                    </td>
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->keterangan }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $barang->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $barang->created_id }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $barang->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $barang->updated_id }}</td>
                    <td>{{ $barang->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
