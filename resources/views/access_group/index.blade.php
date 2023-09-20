@extends('layouts.app')
@section('title', 'Access Group')
@section('content')
    <h4>
        Daftar Access Group
    </h4>
    <div class="table-responsive">
        @can('access', 'access_group_create')
            <a class="btn btn-info mb-4" href="{{ route('access_groups.create') }}">Tambah Access
                Group</a>
        @endcan
        <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
        <table
            class="table table-hover table-bordered convert-data-table display">
            <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Name</th>
                <th>Keterangan</th>
                <th>Access Detail</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>Updated At</th>
                <th>Updated By</th>
            </tr>

            </thead>
            <tbody>
            @foreach ($data as $access_group)
                <tr>
                    <td>
                        @can('access', 'access_group_update')
                            <a href="{{ route('access_groups.edit', base64_encode($access_group->id)) }}"
                               class="btn btn-sm btn-warning">Edit</a>
                        @endcan
                        @can('access', 'access_group_read')
                            <a href="{{ route('access_groups.show', base64_encode($access_group->id)) }}"
                               class="btn btn-sm btn-success mt-2">Show</a>
                        @endcan
                        @can('access', 'access_group_delete')
                            <button class="btn btn-sm btn-danger btn-delete mt-2">Delete</button>
                            <form class="delete-form" action="{{ route('access_groups.destroy', $access_group->id) }}"
                                  method="POST"
                                  class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endcan
                    </td>
                    <td>{{ $access_group->id }}</td>
                    <td>{{ $access_group->nama }}</td>
                    <td>{{ $access_group->keterangan ?? '-' }}</td>
                    <td>{{ str_replace(";;", ",\n", $access_group->access_detail) }}</td>
                    <td>{{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $access_group->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $access_group->created_id }}</td>
                    <td>{{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $access_group->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $access_group->updated_id }}</td>
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
