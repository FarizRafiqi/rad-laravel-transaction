@extends('layouts.app')
@section('title', 'Access Master')
@section('content')
<div class="right_col" role="main">
    <div class="container">
        <header class="panel-heading">
            <?php if ($data['actions'] == 'store') echo 'Tambah';
                                else echo 'Ubah'; ?> Access Master
        </header>
        <div class="panel-body mt-4" id="toro-area">
            <form id="toro-form" method="POST"
                action="{{ ($data['actions'] == 'store') ? route('access_masters.store') : route('access_masters.update', base64_encode($data['access_master']->id)) }}">
                @if($data['actions']=='update') @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama"
                            value="{{ $data['access_master']->nama }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="textarea form-control" rows="8" name="keterangan"
                            >{{ $data['access_master']->keterangan }}</textarea>
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
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama"
                             required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="textarea form-control" rows="8"
                            name="keterangan"></textarea>
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
