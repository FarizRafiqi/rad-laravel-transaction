@extends('layouts.app')

@section('content')
    <h2>Selamat datang, {{ optional(Auth::user())->name }}!</h2>
    <div class="row mt-4">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            Jumlah Barang
                        </div>
                        <div class="col-4 text-right">
                            <b>{{ $jumlahBarang }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            Jumlah Order
                        </div>
                        <div class="col-4 text-right">
                            <b>{{ $jumlahOrder }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            Jumlah Pengguna
                        </div>
                        <div class="col-4 text-right">
                            <b>{{ $jumlahPengguna }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            Jumlah Request Order
                        </div>
                        <div class="col-4 text-right">
                            <b>{{ $jumlahReqOrder }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
