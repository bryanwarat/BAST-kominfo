@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Edit Pengguna</h4>
        </div>
        <div class="flex-shrink-0 mt-3 mt-sm-0">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (kosongkan jika tidak ingin diubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
@endsection
