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
                <th>Created At</th>
                <th>Created By</th>
                <th>Updated At</th>
                <th>Updated By</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $barang)
                <tr>
                    <td>
                        @can('access', 'barang_update')
                            <a href="{{ route('barang.edit', $barang->id) }}"
                               class="btn btn-sm btn-warning mr-2">Edit</a>
                        @endcan
                        @can('access', 'barang_read')
                            <a href="{{ route('barang.show', $barang->id) }}"
                               class="btn btn-sm btn-success mr-2 mt-2 mt-md-0">Show</a>
                        @endcan
                        @can('access', 'barang_delete')
                            <button class="btn btn-sm btn-danger btn-delete mt-2 mt-md-0">Delete</button>
                            <form class="delete-form" action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                  class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
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
@push('script')
    <script>
        $('.btn-delete').on('click', function (event) {
            event.preventDefault();
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapusnya?');
            if (confirmDelete) {
                $(this).siblings('.delete-form').submit();
            }
        });
    </script>
@endpush
