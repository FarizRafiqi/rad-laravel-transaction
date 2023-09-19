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
                                Daftar Order
                            </header>
                            <div class="panel-body" id="toro-area">
                                @can('access','order_create')
                                <a class="btn btn-info" href="{{ route('order.create') }}">Tambah Order</a>
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
                                                <th>ID Vendor</th>
                                                <th>ID User Verfikasi</th>
                                                <th>Jumlah</th>
                                                <th>PPN</th>
                                                <th>PPN Nominal</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>
                                                <th>Updated At</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        @foreach ($data as $order)
                                        <tr>
                                            <td>
                                                @can('access', 'order_update')
                                                <a href="{{ route('order.edit', base64_encode($order->id)) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('access', 'order_read')
                                                <a href="{{ route('order.show', base64_encode($order->id)) }}" class="btn btn-success mt-3">Show</a>
                                                @endcan
                                            </td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->tanggal }}</td>
                                            <td>{{ $order->tanggal_dibutuhkan }}</td>
                                            <td>{{ $order->no_faktur }}</td>
                                            <td>{{ $order->id_m_vendor }}</td>
                                            <td>{{ $order->id_user_verifikasi }}</td>
                                            <td>{{ $order->jumlah }}</td>
                                            <td>{{ $order->ppn_percent }}</td>
                                            <td>{{ $order->pp_nominal }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $order->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $order->created_id }}</td>
                                            <td>{{date_format(Carbon::createFromFormat('Y-m-d H:i:s',
                                            $order->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                                            <td>{{ $order->updated_id }}</td>
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
