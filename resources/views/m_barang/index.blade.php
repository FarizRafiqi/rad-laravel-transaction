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
                                Daftar Barang
                            </header>
                            <div class="panel-body" id="toro-area">
                                @can('access','barang_create')
                                <a class="btn btn-info" href="{{ route('barang.create') }}">Tambah Barang</a>
                                @endcan
                                <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data"
                                    class=" table table-hover table-bordered convert-data-table display" width="100%">
                                    <table class="table">
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
                                        @foreach ($data as $barang)
                                        <tr>
                                            <td>
                                                @can('access', 'barang_update')
                                                <a href="{{ route('barang.edit', base64_encode($barang->id)) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('access', 'barang_read')
                                                <a href="{{ route('barang.show', base64_encode($barang->id)) }}" class="btn btn-success mt-3">Show</a>
                                                @endcan
                                            </td>
                                            <td>{{ $barang->id }}</td>
                                            <td>{{ $barang->nama }}</td>
                                            <td>{{ $barang->keterangan }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $barang->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $barang->created_id }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $barang->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $barang->updated_id }}</td>
                                            <td>{{ $barang->status }}</td>
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
