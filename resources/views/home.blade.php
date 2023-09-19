@extends('layouts.app')

@section('content')
    <h2>Selamat datang, {{ optional(Auth::user())->name }}!</h2>
    <div class="row mt-4">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>
    </div>
@endsection
