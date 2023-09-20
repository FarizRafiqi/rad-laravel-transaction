@extends('layouts.app')
@section('title', 'Banner')
@section('content')
    <h4>Daftar Order</h4>
    <div class="table-responsive" id="toro-area">
        @can('access','order_create')
            <a class="btn btn-info mb-4" href="{{ route('orders.create') }}">Tambah Order</a>
        @endcan
        <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
        <table id="toro-data"
               class="table table-hover table-bordered convert-data-table display">
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
            <tbody>
            @foreach ($data as $order)
                <tr>
                    <td>
                        @can('access', 'order_update')
                            <a href="{{ route('orders.edit', base64_encode($order->id)) }}"
                               class="btn btn-sm btn-warning">Edit</a>
                        @endcan
                        @can('access', 'order_read')
                            <a href="{{ route('orders.show', base64_encode($order->id)) }}"
                               class="btn btn-sm btn-success mt-2">Show</a>
                        @endcan
                        @can('access', 'order_delete')
                            <button class="btn btn-sm btn-danger btn-delete mt-2">Delete</button>
                            <form class="delete-form" action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                  class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
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
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $order->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $order->created_id }}</td>
                    <td>{{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $order->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</td>
                    <td>{{ $order->updated_id }}</td>
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
