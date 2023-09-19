@extends('layouts.app')
@section('title', 'Banner')
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
                                Daftar Permintaan
                            </header>
                            <div class="panel-body" id="toro-area">
                                @can('access','minta_create')
                                <a class="btn btn-info" href="{{ route('minta.create') }}">Tambah Permintaan</a>
                                @endcan
                                <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data"
                                    class=" table table-hover table-bordered convert-data-table display" width="100%">
                                    <table class="table">
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
                                        @foreach ($data as $minta)
                                        <tr>
                                            <td>
                                                @can('access', 'minta_update')
                                                <a href="{{ route('minta.edit', base64_encode($minta->id)) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('access', 'minta_read')
                                                <a href="{{ route('minta.show', base64_encode($minta->id)) }}" class="btn btn-success mt-3">Show</a>
                                                @endcan
                                            </td>
                                            <td>{{ $minta->id }}</td>
                                            <td>{{ $minta->tanggal }}</td>
                                            <td>{{ $minta->tanggal_dibutuhkan }}</td>
                                            <td>{{ $minta->no_faktur }}</td>
                                            <td>{{ $minta->id_user_pemohon }}</td>
                                            <td>{{ $minta->id_user_menyetujui }}</td>
                                            <td>{{ $minta->status }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $minta->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $minta->created_id }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $minta->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $minta->updated_id }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
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
