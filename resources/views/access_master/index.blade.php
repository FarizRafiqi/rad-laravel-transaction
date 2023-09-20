@extends('layouts.app')
@section('title', 'Access Master')
@section('content')
    <h4>Daftar Access Master</h4>
    <div class="table-responsive">
        @can('access','access_master_create')
            <a class="btn btn-info mb-4" href="{{ route('access_masters.create') }}">Tambah Access
                Master</a>
        @endcan
        <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
        <table
            class="table table-hover table-bordered convert-data-table display">
            <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>Updated At</th>
                <th>Updated By</th>
            </tr>
            </thead>
            @foreach ($data as $access_master)
                <tr>
                    <td>
                        @can('access', 'access_group_update')
                            <a href="{{ route('access_masters.edit', base64_encode($access_master->id)) }}"
                               class="btn btn-sm btn-warning mr-2">Edit</a>
                        @endcan
                        @can('access', 'access_group_read')
                            <a href="{{ route('access_masters.show', base64_encode($access_master->id)) }}"
                               class="btn btn-sm btn-success">Show</a>
                        @endcan
                        @can('access', 'access_group_delete')
                            <button class="btn btn-sm btn-danger btn-delete mt-2 mt-md-0">Delete</button>
                            <form class="delete-form" action="{{ route('access_masters.destroy', $access_master->id) }}" method="POST"
                                  class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endcan
                    </td>
                    <td>{{ $access_master->id }}</td>
                    <td>{{ $access_master->nama }}</td>
                    <td>{{ $access_master->keterangan ?? '-' }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $access_master->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $access_master->created_id }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $access_master->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $access_master->updated_id }}</td>
                </tr>
            @endforeach
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
