@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail Pengguna</h4>
        </div>
        <div class="flex-shrink-0 mt-3 mt-sm-0">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>
            </dl>
        </div>
    </div>
@endsection
