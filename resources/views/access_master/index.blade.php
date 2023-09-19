@extends('layouts.app')
@section('title', 'Access Master')
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
                                Daftar Access Master
                            </header>
                            <div class="panel-body" id="toro-area">
                                @can('access','access_master_create')
                                <a class="btn btn-info" href="{{ route('access_masters.create') }}">Tambah Access
                                    Master</a>
                                @endcan
                                <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data"
                                    class=" table table-hover table-bordered convert-data-table display" width="100%">
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
                                                class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('access', 'access_group_read')
                                            <a href="{{ route('access_masters.show', base64_encode($access_master->id)) }}"
                                                class="btn btn-success mt-3">Show</a>
                                            @endcan
                                        </td>
                                        <td>{{ $access_master->id }}</td>
                                        <td>{{ $access_master->nama }}</td>
                                        <td>{{ $access_master->keterangan }}</td>
                                        <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $access_master->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>

                                        <td>{{ $access_master->created_id }}</td>
                                        <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $access_master->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                        <td>{{ $access_master->updated_id }}</td>
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
