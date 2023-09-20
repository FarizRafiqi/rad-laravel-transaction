@extends('layouts.app')
@section('title', 'User')
@section('content')
    <h4>Daftar User</h4>
    <div class="table-responsive">
        @can('access','users_create')
            <a class="btn btn-info mb-4" href="{{ route('users.create') }}">Tambah User</a>
        @endcan
        <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
        <table class="table table-hover table-bordered convert-data-table display">
            <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Access Group</th>
            </tr>
            </thead>
            @foreach ($data as $users)
                <tr>
                    <td>
                        @can('access', 'users_update')
                            <a href="{{ route('users.edit', base64_encode($users->id)) }}"
                               class="btn btn-sm btn-warning">Edit</a>
                        @endcan
                        @can('access', 'users_read')
                            <a href="{{ route('users.show', base64_encode($users->id)) }}"
                               class="btn btn-sm btn-success mx-2">Show</a>
                        @endcan
                        @can('access', 'users_delete')
                            <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                            <form class="delete-form" action="{{ route('users.destroy', $users->id) }}" method="POST"
                                  class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endcan
                    </td>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $users->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $users->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $users->id_access_group }}</td>
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
