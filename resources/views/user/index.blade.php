@extends('layouts.app')
@section('title', 'User')
@section('content')
<?php

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
?>
<div class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-5">
    <div class="">
        <div class="row top_tiles">
            <div class="wrapper">
                <div class="row" id="row-report">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                DAFTAR USER
                            </header>
                            <div class="panel-body" id="toro-area">
                                @can('access','users_create')
                                    <a class="btn btn-info" href="{{ route('users.create') }}">Tambah User</a>
                                @endcan
                                <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data" class=" table" width="100%">
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
                                            <a href="{{ route('users.edit', base64_encode($users->id)) }}" class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('access', 'users_read')
                                            <a href="{{ route('users.show', base64_encode($users->id)) }}" class="btn btn-success">Show</a>
                                            @endcan
                                        </td>
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $users->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                        <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $users->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                        <td>{{ $users->id_access_group }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
