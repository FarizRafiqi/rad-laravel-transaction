@extends('layouts.app')
@section('title', 'Access Master')
@section('content')
    <div class="right_col" role="main">
        <div class="container">
            <h4 class="panel-heading">
                @if($data['actions'] == 'store')
                    Tambah
                @else
                    Ubah
                @endif
                Permintaan Pembelian
            </h4>
            <div class="panel-body mt-4" id="toro-area">
                <form id="toro-form" method="POST"
                      action="{{ ($data['actions'] == 'store') ? route('purchase-requests.store') : route('purchase-requests.update', $data['beli_minta']->id) }}">
                    @if($data['actions']=='update')
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                       placeholder="Masukkan Tanggal" value="{{ $data['beli_minta']->tanggal }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_dibutuhkan" class="col-sm-2 col-form-label">Tanggal Dibutuhkan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_dibutuhkan"
                                       name="tanggal_dibutuhkan"
                                       placeholder="Masukkan Tanggal Dibutuhkan"
                                       value="{{ $data['beli_minta']->tanggal_dibutuhkan }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_faktur" class="col-sm-2 col-form-label">No Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                       placeholder="Masukkan No Faktur" value="{{ $data['beli_minta']->no_faktur }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_pemohon" class="col-sm-2 col-form-label">Pemohon</label>
                            <div class="col-sm-10">
                                <select name="id_user_pemohon" id="id_user_pemohon" class="form-control" required>
                                    <option disabled>Pilih Pemohon</option>
                                    @foreach($data['beli_minta'] as $purchaseRequest)
                                        <option value="{{ $purchaseRequest->id }}">{{ $purchaseRequest->userPemohon()->name }}</option>
                                    @endforeach
                                </select>
{{--                                <input type="text" class="form-control" id="id_user_pemohon" name="id_user_pemohon"--}}
{{--                                       placeholder="Masukkan Nama Pemohon"--}}
{{--                                       value="{{ $data['beli_minta']->id_user_pemohon }}" required>--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_menyetujui" class="col-sm-2 col-form-label">ID User Verifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_user_menyetujui"
                                       name="id_user_menyetujui"
                                       placeholder="Masukkan User Menyetujui"
                                       value="{{ $data['beli_minta']->id_user_menyetujui }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" name="status"
                                       placeholder="0 = not completed, 1 = completed, 2 = partial, 3 = canceled"
                                       value="{{ $data['beli_minta']->status }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    @else
                        @csrf
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                       placeholder="Masukkan Tanggal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_dibutuhkan" class="col-sm-2 col-form-label">Tanggal Dibutuhkan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_dibutuhkan"
                                       name="tanggal_dibutuhkan"
                                       placeholder="Masukkan Tanggal Dibutuhkan"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_faktur" class="col-sm-2 col-form-label">No Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                       placeholder="Masukkan No Faktur" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_pemohon" class="col-sm-2 col-form-label">Pemohon</label>
                            <div class="col-sm-10">
                                <select name="id_user_pemohon" id="id_user_pemohon" class="form-control" required>
                                    <option disabled>Pilih Pemohon</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_menyetujui" class="col-sm-2 col-form-label">User Menyetujui</label>
                            <div class="col-sm-10">
                                <select name="id_user_menyetujui" id="id_user_menyetujui" class="form-control" required>
                                    <option disabled>Pilih Penyetuju</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" name="status"
                                       placeholder="0 = not completed, 1 = completed, 2 = partial, 3 = canceled"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
